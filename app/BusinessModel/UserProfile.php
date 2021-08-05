<?php

namespace App\BusinessModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp;

use Hash;
use Mail;
use App\Mail\UserVerifyEmail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\UserForgotPasswordMail;
use DB;

use Illuminate\Support\Str;
use App\Models\User;

class UserProfile extends Model
{


	//destination path of image upload

    public static function uploadImage($image, $destinationPath)
    {
        $imageName = date('mdYHis') . uniqid().'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        return $imageName;
    }

    //base 64 upload image
    public static function uploadBase64A($data) 
    {
        $destinationPath = storage_path(). DIRECTORY_SEPARATOR . env('IMAGES_STORAGE');
        $image1 = str_replace('data:image/jpeg;base64,', '', $data);
        $image1 = str_replace('data:image/png;base64,', '', $image1);
        $image1 = str_replace(' ', '+', $image1);
        $imageName = date('mdYHis') . '1' . uniqid().'.png';
        file_put_contents($destinationPath. '/' . $imageName, base64_decode($image1));
        return $imageName;
    }


    public static function responseWithErrorCode($message=null, $code)
    {

        http_response_code($code);
        $message = $message ? $message : "Something went wrong. Please try again later!";
        echo json_encode(['result' => 'Failure', 'message' => $message]); exit;
    }


    //store data when registerd user
  public static function store($request, $id=null){
       

        $data = $request->toArray();

        if($id){
            $user = User::find($id);
        }else{
            $user = new User();
            $data['verify_email_token'] = Str::random(32);
        }

        if($request->password){
            $data['password'] = Hash::make($request->password);
        }

        if($request->device_token == "dummy_token"){
            $data['is_verify'] = 1;
        }

        if(!empty($data['profile_image'])) {

            if($request->upload_img_ajax == 1){
                $data['profile_image'] = self::uploadBase64A($data['profile_image']);

            }else{

                 $destinationPath = storage_path(). DIRECTORY_SEPARATOR . "app/public/users";
                $data['profile_image'] = self::uploadImage($data['profile_image'], $destinationPath);
            }
        }
        

        $user->fill($data);
        if(empty($id) && $request->device_token != "dummy_token"){

            //mail send
            $token = $user->verify_email_token;
            $link = url("confirm-account/$token");
            $logo = url("public/admin/assets/img/kush.png");
            try{
                \Mail::to($user->email)->send(new UserVerifyEmail($user, $link, $logo));
            }catch(\Exception $ex){
                return self::responseWithErrorCode($ex->getMessage(),400);
            }
        }

        if($user->save()) {
            $user_get = User::find($user->id);
            $user->access_token =  $user_get->createToken('Knest')->accessToken;
            return $user;
        } else {
            return false;
        }
    }


    public static function verifyAccount($request){
        $token = $request->verify_email_token;
        $user = User::whereVerifyEmailToken($token)->first();

        if($user){
            $user->verify_email_token = "";
            $user->is_verify = 1;
            $user->update();
            return true;
            
        }else {
            
            return false;
        }
    }

    public static function login($request){
        $email          = $request->email;
        $password       = $request->password;
        $device_type    = $request->device_type;
        $device_token   = $request->device_token;

        $check_email = User::whereEmail($request->email)->first();

        if($check_email){
             
            if($check_email->is_verify == 0) {
                return self::responseWithErrorCode('Account verification is pending. Please verify the account first to login in to application.',400);
            }

            if($check_email->is_blocked == 1) {
                return self::responseWithErrorCode('Your account has been blocked by admin.',400);
            }

            if($check_email->deleted_at != '') {
                return self::responseWithErrorCode('Your account has been deleted by admin.',400);
            }

            if(Hash::check($password, $check_email->password)) {
                $check_email->device_type = $device_type;
                $check_email->device_token = $device_token ? $device_token : "";
                $check_email->update();

                $user_data = User::find($check_email->id);
                $user_data->access_token = $user_data->createToken('Knest')->accessToken;

                return $user_data;
                
            } else { 
                return false;
                
            }
        } else {
            return false;
            
        }

    }


    public static function updateProfile($request, $user){
        $update = self::store($request, $user->id);
        return $update;
    }

    public static function forgotPassword($request){

        $user = User::whereEmail($request->email)->first();
        if($user) {

            if($user->is_verify == 0) {
                return self::responseWithErrorCode('Account verification pending please verify first.',400);
            }

            if($user->is_blocked == 1) {
                return self::responseWithErrorCode('Your account has been blocked by admin.',400);
            }

            if($user->deleted_at != '') {
                return self::responseWithErrorCode('Your account has been deleted by admin.',400);
            }


            $reset_password_token = Str::random(32);

            $link = url("reset-password/$reset_password_token"); 
            $logo = url("public/admin/assets/img/kush.png");
            
            try{
                Mail::to($user->email)->send(new UserForgotPasswordMail($user, $link, $logo));
                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'token' => $reset_password_token, //change 60 to any length you want
                    'created_at' => Carbon::now()
                ]);
            }catch(\Exception $ex) {
                    return self::responseWithErrorCode($ex->getMessage(),400);
                    //$this->responseWithError('Something went wrong please try again.');
            }

            return true;
            
        }else{
            return false;
            
        }
    }

    public static function resetPassword($request){
        if($request->password == $request->confirm_password) { 

            $data = DB::table('password_resets')
                ->whereToken($request->reset_password_token);

            $tokenData = $data->first();
            $user = User::where(['email' => $tokenData->email])->first();
            $user->update(['password' => Hash::make($request->password)]);

            $data->delete();

            return true;

        }else{
            return false;
            
        } 
    }

    
    public static function  logout(Request $request){  
        $id = Auth::id(); 
        DB::table('oauth_access_tokens')
        ->where('user_id', $id)
        ->update([
            'revoked' => true
        ]);
        User::find($id)->update(["device_token" => ""]);

        return response()->json(['message' => "Logout successfully "]); 
    }

       

}
