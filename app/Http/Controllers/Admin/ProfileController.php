<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Validator;
use Auth;
use Redirect;
use DB;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\Mail;
use Carbon\carbon;
use Hash;
use App\Http\Controllers\Api\v1\ResponseController;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
use App\BusinessModel\UserProfile;
use App\BusinessModel\AdminProfile;

class ProfileController extends ResponseController
{


      public function UserProfileModel(){
        return new UserProfileModel();
      }

    public function AdminProfileModel(){
        return new AdminProfileModel();
    }

    public function manageAccount(Request $request){
    	if($request->isMethod('GET')){
           $admin_find = Admin::first();
    		return view('admin.pages.my-account.update-email',compact('admin_find'));
    	}

    	if($request->isMethod('POST')){
              $admin_find = Admin::first();
               $message = [

            'email_address.required'    => 'Please enter name.',
            'phone_number.required'     => 'Please enter phone number.',   
            'email.required'            => 'Please enter email address.',
            'email.email'              =>'Please enter a valid email address.',
           ];
            $this->validate($request, [
           
            'phone_number'  => 'required|numeric|digits_between:8,15|unique:users,phone_number',
            'email'         => 'required|email|max:50|unique:users,email',
            
           ],$message);

            $userData = [
                'email'=>$request->email,
                'phone_number'=>$request->phone_number
               
           ]; 
            $where=['id'=>$admin_find->id];
            $updateProfile =Admin::where($where)->update($userData);
        

            if($updateProfile){
                 Session::flash('message','Account has been updated successfully.');
                 return redirect('admin/manage-account');
            }else{
                Session::flash('danger', 'Unable to proceed your request, Please try later.');
                return back(); 
            }
            
    	}
    }

    public function updatePassword(Request $request){
    	if($request->isMethod('GET')){

    		return view('admin.pages.my-account.change-password');
    	}

    	if($request->isMethod('POST')){
           $admin = Admin::first();
            $message = [
                'old_password.required'     => 'Please enter old password.',
                'new_password.required'     => 'Please enter new password.',
                'confirm_password.required' => "Please enter confirm password.",
                'new_password.min'          => 'New password must be at least 6 characters.',
                'confirm_password.min'      => "Confirm password must be at least 6 characters.",
                'confirm_password.same'     => "Password and confirm password does not match."
            ];
            $this->validate($request, [
                'old_password'      => 'required',
                'new_password'      => 'required|min:6,max:20',
                'confirm_password'  => 'required|required_with:new_password|same:new_password||min:6,max:20'
            ],$message);

             $old_password = $request->old_password;
            if(Hash::check($old_password,$admin->password)) {
            $updatePassword = Admin::where(['id' => $admin->id])->update(['password' => Hash::make($request->new_password)]);
                $request->session()->flush();
                $request->session()->regenerate();
                Session::flash('success', 'Password has been changed successfully.');
                return redirect(url('admin/login'));
            } else {
                Session::flash('danger', 'Please enter valid current password.');
                return back()->withInput();
            }
    	}
    }
     public function login(Request $request){
        if(Auth::guard("admin")->check()){
            return Redirect::to("admin/dashboard");
        }

        if($request->isMethod("GET")){
            return view("admin/pages/my-account/login");
        }

        if($request->isMethod('POST')) {
            $messages = [
                'email.email'       =>  'Please enter a valid email address.',
                'email.exists'      =>  'Please enter registered email address.',
                'email.required'    =>  'Please enter email address.',
                'password.required' =>  'Please enter password.',
                'password.min'      =>  'Password must be at least 6 characters.',
            ];

            $data = $this->validate($request,[
                'email'     => 'required|email',
                'password'  => 'required',
            ], $messages);

            if(Auth::guard('admin')->attempt(['email' => $request->email,'password' => $request->password])) {
                $login_token = Str::random(32);
                $where = ['email' => $request->email];
                $data = ['login_token' => $login_token];
                $update_admin =AdminProfile::updateAdmin($where,$data);
                Session::flash('success', 'Logged in Successfully');
                return redirect(url('admin/dashboard')); 
            } else {
                Session::flash('danger', 'Please enter valid email address or password.');
                return back()->withInput();
            }
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        Session::flash('message','Admin logout successfully');
        return redirect(route('admin.login'));
    }

    public function forgotPassword(Request $request){
    	if($request->isMethod('GET')){

    		return view('admin.pages.my-account.forgot-password');
    	}

    	if($request->isMethod('POST')){

            $Validator = $this->is_validationRuleWeb(Admin::forgotPasswordValidation(), $request);
            if(!empty($Validator)){
                return $Validator;
            }
            
            $forgot_password = AdminProfile::forgotPassword($request);

            if($forgot_password == "failed"){
                return redirect()->back();
            }else{

                Session::flash('message','A reset password link has been sent to your registered email address');
                return redirect()->back();
            }


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

            $Validator = $this->is_validationRuleWeb(Admin::resetPasswordValidation(), $request);
            if(!empty($Validator)){
                return $Validator;
            }
        
            $reset_password = AdminProfile::resetPassword($request);

            if($reset_password == true){
                return redirect(route('admin.passwordReset'));
            }else{
                return redirect(route('passwordResetInvalid'));
            }

        }
    }

    public function viewMessageResetPassword(Request $request){
        $title = "Password Reset Success";
        $message = "Password has been reset successfully.";
        $type = "success";
        $link = url('admin/login');
        return view('user.email.feedback', compact('title', 'message', 'type','link'));
    }

}
