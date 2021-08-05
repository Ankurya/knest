<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Auth;
use Redirect;
use DB;
use Illuminate\Support\Str;
use Session;
use Illuminate\Support\Facades\Mail;
use Carbon\carbon;
use Hash;
use App\Models\Admin;
use App\Mail\AdminForgotPassword;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\BusinessModel\AdminProfile;

class Admin extends Authenticatable
{
    protected $fillable = [
    	'name',
    	'email',
    	'password',
    	'remember_token',
    	'login_token',
    	'reset_password_token'
    ];

    //validations

    public static function loginValidation($validation = "", $message = ""){
    	$validation = [
            'email'   	=> 'required|email',
            'password' 	=> 'required|min:6|max:20',
        ];

        $message = [
            'password.required' =>	'Please enter password.',
            'password.min' 		=>	'Password must be at least 6 characters.',
            'password.max' 		=>	'Password may not be greater than 20 characters.',
            'email.required'	=>	'Please enter email address.',
            'email.email'		=>	'Please enter valid email address.'
        ];

        return $data = ['validation' => $validation, 'message' => $message];
    }

    public static function forgotPasswordValidation($validation = "", $message = ""){
        $validation = [
            'email'     => 'required|email|exists:admins',
        ];

        $message = [
            'email.required'    =>  'Please enter email address.',
            'email.email'       =>  'Please enter valid email address.',
            'email.exists'      =>  "Email address doesn't exist."
        ];

        return $data = ['validation' => $validation, 'message' => $message];
    } 

    public static function resetPasswordValidation($validation = "", $message = ""){
        $validation = [
            'password'          => 'required|max:50|min:6',
            'confirm_password'  => 'required|max:50|min:6|same:password',
        ];

        $message = [
            'password.required'          =>  'Please enter password.',
            'confirm_password.required'  =>  'Please enter confirm password.',
            'confirm_password.same'      =>  'New password and confirm password must be same.'
        ];

        return $data = ['validation' => $validation, 'message' => $message];
    }

    
}
