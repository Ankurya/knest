<?php

namespace App\Http\Controllers\Api\v1;

use DB;
use Mail;
use Hash;
use Validator;
use GuzzleHttp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\v1\ResponseController;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\BusinessModel\UserProfile;


date_default_timezone_set('UTC');

class AuthenticateController extends ResponseController
{
    public function register(Request $request){

    	$this->is_validationRule(User::validationOnRule(), $request);
    	$data = UserProfile::store($request);
    	if($data){
    		return $this->responseOk('You have registered successfully. Please verify your email to login.');
    	}else{
    		return $this->responseWithErrorCode('User Registered Failed',400);
    	}
    }

    public function confirmAccount(Request $request){

    	$account_verify = UserProfile::verifyAccount($request);

    	if($account_verify == true){
    		$title = "Email verified";
            $message = "Your email has been verified successfully. You may now login.";
            $type = "success";
            return view('user.email.feedback', compact('title', 'message', 'type'));
    	}

    	if($account_verify == false){
    		$title = "Invalid link";
            $message = "Your verification link is either expired or invalid.";
            $type = "danger";
            return view('user.email.feedback', compact('title', 'message', 'type'));
    	}
        
    }

    public function login(Request $request){
    	$this->is_validationRule(User::validationOnRule1(), $request);
    	$login = UserProfile::login($request);

    	if($login == false){
    		return $this->responseWithErrorCode('Please enter a valid email or password.',400);
    	}else{

    		return $this->responseOk('User Login Successfully.', $login);
    	}

    }

    public function updateProfile(Request $request){

    	if($request->isMethod('GET')){
    		$user = auth()->user();
    		return $this->responseOk('User Profile', $user);

    	}

    	if($request->isMethod('POST')){

	    	$user = auth()->user();
	    	$this->is_validationRule(User::validationOnRule2(), $request);
	    	$updateProfile = UserProfile::updateProfile($request, $user);

	    	if($updateProfile == false){
	    		return $this->responseWithErrorCode('Something went wrong please try again',400);
	    	}else{

	    		return $this->responseOk('Profile updated successfully', $updateProfile);
	    	}
    	}

    }

    public function forgotPassword(Request $request){


        $this->is_validationRule(User::validationOnRule3(), $request);
       	$forgotPassword = UserProfile::forgotPassword($request);

       	if($forgotPassword == true){
       		return $this->responseOk('A reset password link has been sent to your registered email address');
       	}else{
       		return $this->responseWithErrorCode("Email address is not registered with us.",400);
       	}
    }


    public function resetPassword(Request $request){ 

        if($request->isMethod('GET')){

            $token = $request->reset_password_token;

            $tokenData = DB::table('password_resets')
                ->whereToken($token)->first();

            if(!$tokenData) {
                return redirect(route('passwordResetInvalid'));
            }

            if(Carbon::now() > Carbon::parse($tokenData->created_at)->addMinutes(10)){
                return redirect(route('passwordResetInvalid'));
            }

            return view('user.email.reset-password', compact('token'));
        }

        if($request->isMethod('POST')){

            $messages = [
            'password.required'          =>  'Please enter new password.',
            'confirm_password.required'  =>  'Please enter confirm password.',
            'confirm_password.same'      =>  'New password and confirm password must be same.',
            'confirm_password.min'       =>  'Confirm password should be at least 6 Characters long.',
            'password.min'               =>  'New password must be at least 6 characters long.'
            ];

            $this->validate($request, [
                'password'          => 'required|max:50|min:6',
                'confirm_password'  => 'required|max:50|min:6|same:password',
            ], $messages);

            $reset_password = UserProfile::resetPassword($request);

            if($reset_password == true){
            	return redirect(route('passwordReset'));
            }else{
            	return redirect(route('passwordResetInvalid'));
            }
        }
    }

    public function viewMessageResetPassword(){

        $title = "Password Reset Success";
        $message = "Password has been reset successfully.";
        $type = "success";
        return view('user.email.feedback', compact('title', 'message', 'type'));
    }

    public function viewMessageResetPasswordInvalid(){

        $title = "Invalid link";
        $message = "The link has been expired. Please try new one.";
        $type = "danger";
        return view('user.email.feedback', compact('title', 'message', 'type'));
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
