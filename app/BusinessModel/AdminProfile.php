<?php

namespace App\BusinessModel;

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
use App\Models\User;
use App\Mail\AdminForgotPassword;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);

class AdminProfile extends Model
{
   
      public static function updateAdmin(array $where,array $data){
        return Admin::where($where)->update($data);
      }

      public static function createUser(array $data){
        return User::create($data);
      }

    public static function updateUser(array $where,array $data){
        return User::where($where)->update($data);
    }

      public static function getUser(array $where){
        return User::where($where)->first();
    }
    
    public static function forgotPassword($request){
        $admin = Admin::whereEmail($request->email)->first();
        $reset_password_token = Str::random(32);

        $link = url("admin/reset-password/$reset_password_token"); 
        $logo = url("public/admin/assets/img/kush.png");

        try{
            \Mail::to($admin->email)->send(new AdminForgotPassword($link, $logo));

            DB::table('password_resets')->insert([
                    'email' => $admin->email,
                    'token' => $reset_password_token, //change 60 to any length you want
                    'created_at' => Carbon::now()
                ]);

        }catch(\Exception $ex){

            Session::flash('danger',"Something went wrong please try again.");
            return "failed";
        }
        return "success";
    }

    public static function resetPassword($request){

        if($request->password == $request->confirm_password) { 

            $data = DB::table('password_resets')
                ->whereToken($request->reset_password_token);

            $tokenData = $data->first();
            $admin = Admin::where(['email' => $tokenData->email])->first();
            $admin->update(['password' => Hash::make($request->password)]);

            $data->delete();

            return true;

        }else{
            return false;
            
        } 
    }


   
}
