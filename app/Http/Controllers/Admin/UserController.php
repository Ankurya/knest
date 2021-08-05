<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
use App\Http\Controllers\Api\v1\ResponseController;
use Session;
use Hash;
use Carbon\Carbon;
use App\Models\Property;
use App\Models\PropertyImages;
use App\BusinessModel\UserProfile;
use App\BusinessModel\AdminProfile;
use GuzzleHttp;
class UserController extends ResponseController
{

     private function UserProfileModel(){
        return new UserProfileModel();
    }

    private function AdminProfileModel(){
        return new AdminProfileModel();
    }

    public function userManagement(Request $request){
    	if($request->isMethod('GET')){

            $users = User::orderBy('id','desc')->get();
    		return view('admin.pages.user-management.user-management',compact('users'));
    	}
    }


    public function addUser(Request $request){
    	if($request->isMethod('GET')){

    		return view('admin.pages.user-management.add-user');
    	}

    	if($request->isMethod('POST')){
          
      //  return $request->all();
               $message = [

            'name.required'             => 'Please enter name.',
            'phone_number.required'     => 'Please enter phone number.',
            'city.required'             => 'Please enter city name.',
            'city.regex'                => 'The city should be enter in characters only.',
            'pin_code.required'         => 'Please enter pin code.',
            'email.required'            => 'Please enter email address.',
            'password.required'         => 'Please enter password.',
            'password.min'              =>'Password should be atleast 6 characters long.',
            'email.email'              =>'Please enter valid email address.',
           ];
            $this->validate($request, [
            'name'          => 'required|max:35',
            'phone_number'  => 'required|numeric|digits_between:8,15|unique:users,phone_number',
            'city'          => 'required|max:35',
            'pin_code'      => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',

           ],$message);

           // return "1";
        
            if($request->country_code == "") {
                $country_code = '+1';
            } elseif($request->country_code[0] != '+') {
                $country_code = '+'.$request->country_code;
            } else {
                $country_code = $request->country_code;
            }
            $device_token = "";
            $device_type = "Android";

            $userData = [
                'name'=>$request->name,
                'email'=>$request->email,
                'country_code'=>$country_code,
                'pin_code'=>$request->pin_code,
                'city'=>$request->city,
                'phone_number'=>$request->phone_number,
                'password'=> Hash::make($request->password),
                'is_verify'=>1,
                'device_type'=>$device_type,
                'device_token'=>$device_token,
       
           ]; 

            if($request->hasFile("profile_image")){
                $image = $request->file("profile_image");
                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . "app/public/users";
                $userData["profile_image"] = $this->uploadProfile($destinationPath,$image);
            }

            $AddProfile =AdminProfile::createUser($userData);

            if($AddProfile){
                Session::flash('message','User details has been added successfully.');
                return redirect('admin/user-management');
            }else{
                Session::flash('danger', 'Unable to proceed your request, Please try later.');
                return back(); 
            }
            
        }

    	}
    

 public function editUser(Request $request){
        if($request->isMethod('GET')){
            $user_id = base64_decode($request->user_id);
             $where = ['id'=>$user_id];
             $user_find = AdminProfile::getUser($where);
            return view('admin.pages.user-management.edit-user',compact('user_find'));
        }

        if($request->isMethod('POST')){
            //return $request->all();
            $user_id = base64_decode($request->user_id);
            $user = User::find($user_id);
               $message = [

            'name.required'             => 'Please enter name.',
            'country_code.required'     => 'Please enter country code.',
            'phone_number.required'     => 'Please enter phone number.',
            'city.required'             => 'Please enter city name.',
            /*'city.regex'                => 'The city should be enter in characters only.',*/
            'pin_code.required'         => 'Please enter pin code.',
            'email.required'            => 'Please enter email address.',

           ];
            $this->validate($request, [
            'name'          => 'required|max:35',
            'country_code'  => 'required',
            'phone_number'  => 'required|numeric|digits_between:8,15|unique:users,phone_number,'.$user_id,
            'city'          => 'required|max:35',
            'pin_code'      => 'required|string|max:150|alpha_num',
            'email'         => 'required|email|unique:users,email,'.$user_id,
        
           ],$message);
        
            if($request->country_code == "") {
                $country_code = '+1';
            } elseif($request->country_code[0] != '+') {
                $country_code = '+'.$request->country_code;
            } else {
                $country_code = $request->country_code;
            }

             $userData = [
                'name'=>$request->name,
                'email'=>$request->email,
                'country_code'=>$country_code,
                'pin_code'=>$request->pin_code,
                'city'=>$request->city,
                'phone_number'=>$request->phone_number,
               
            ]; 


            if($request->hasFile("profile_image")){
                $image = $request->file("profile_image");
                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . "app/public/users";
                $userData["profile_image"] = $this->uploadProfile($destinationPath,$image);
            }
            $where = ['id'=>$user_id];

            $updatedProfile = AdminProfile::updateUser($where,$userData);
            if($updatedProfile) {
                Session::flash('message','User details has been updated successfully.');
               return redirect('admin/user-management');
            } else {
                Session::flash('danger', 'Unable to proceed your request, Please try later.');
                return back(); 
            }
            
        }
    }

    public function viewUser(Request $request){

        $user_id = base64_decode($request->user_id);
        $where = ['id'=>$user_id];
        $user = AdminProfile::getUser($where);
    	return view('admin.pages.user-management.view-user',compact('user'));
    }

    public function blockUser(Request $request){
        $user_id = base64_decode($request->user_id);
         $where = ['id'=>$user_id];
         $user = AdminProfile::getUser($where);
        if($user->is_blocked == 1){
            $user->is_blocked = 0;
            $user->update();
            Session::flash('message','User unblocked successfully');
        }else{
            $user->is_blocked = 1;
            $user->update();
            Session::flash('message','User blocked successfully');
        }

        return back();

    }

    public function deleteUser(Request $request){
        $user_id = $request->user_id;
        $where = ['id'=>$user_id];
        $user = User::where($where)->delete();
        $property = Property::where(['user_id'=>$user_id])->delete();
        $property = PropertyImages::where(['user_id'=>$user_id])->delete();
        Session::flash('message','User deleted successfully');
        return back();
    }

    private function uploadProfile($destinationPath,$image){
        $imageName = date('mdY') . uniqid().'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        return $imageName;
    }

public function checkEmail(Request $request) {
        $email = $request->email;
        if($email){
          $user_id = $request->user_id;
            if($user_id) {
                $where = [['email',$email],['id','!=',$user_id]];
            } else {
                $where = ["email" => $email];
            }
             $checkUser = AdminProfile::getUser($where);
            if($checkUser) {
                echo(json_encode("Email already exists.")); 
            } else {
                echo(json_encode(true)); 
            }
        }
    }

 /*public function checkUser(array $where){
        $user =  User::where($where)->first();
        if(!$user) {
            $checUser =  User::where($where)->first();
            if(!$checUser) {
                return User::where($where)->first();
            }
            return $checUser;
        }
        return $user;
    }    */

     

}
