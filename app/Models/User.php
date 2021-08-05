<?php

namespace App\models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use GuzzleHttp;
use Hash;
use Mail;
use App\Mail\UserVerifyEmail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\UserForgotPasswordMail;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'country_code',
        'phone_number',
        'city',
        'pin_code',
        'profile_image', 
        'device_type',
        'device_token',
        'email', 
        'password',
        'verify_email_token',
        'is_verify',
        'country_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','verify_email_token','refresh_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //mutators

   public function getProfileImageAttribute($value){
        $base_path = public_path("storage/users");
        $profile = $value;

        if(!empty($profile) && file_exists($base_path.'/'.$profile)){
            return url("public/storage/users").'/'.$profile;
        }
        return "";
    }


    //validation Rule
    public static function validationOnRule($validation="", $message = ""){
        $validation = [

            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'          => 'required|max:35',
            'country_code'  => 'required',
            'phone_number'  => 'required|numeric|digits_between:8,15|unique:users',
            'city'          => 'required|max:35',
            'pin_code'      => 'required|string|max:150|alpha_num',
            'device_type'   => 'required|in:Ios,Android',
            'device_token'  => 'required',
            'email'         => 'required|email|max:50|unique:users',
            'password'      => 'required|max:50|min:6',

        ];
        $message = [

            'name.required'             => 'Please enter name',
            'country_code.required'     => 'Please enter country code',
            'phone_number.required'     => 'Please enter phone number',
            'city.required'             => 'Please enter city name',
            'city.regex'                => 'The city should be enter in characters only',
            'pin_code.required'         => 'Please enter pin code',
            'device_type.required'      => 'Please enter device type',
            'device_token.required'     => 'Please enter device token',
            'email.required'            => 'Please enter email address',
            'password.required'         => 'Please enter password'
        ];


        return $data = ['validation' => $validation, 'message' => $message];
    }



    public static function validationOnRule1($validation="", $message = ""){
        $validation = [

            'device_type'   => 'required|in:Ios,Android',
            'device_token'  => 'required',
            'email'         => 'required|email|max:50|exists:users,email',
            'password'      => 'required',

        ];
        $message = [

            'device_type.required'      => 'Please enter device type',
            'device_token.required'     => 'Please enter device token',
            'email.required'            => 'Please enter email address',
            'password.required'         => 'Please enter password',
            'email.exists'              => 'Invalid email address or password'
        ];


        return $data = ['validation' => $validation, 'message' => $message];
    }

    public static function validationOnRule2($validation="", $message = ""){
      
        $user = auth()->user();

        $validation = [

            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'          => 'max:35',
            //'country_code'  => 'required',
            'phone_number'  => 'numeric|digits_between:8,15|unique:users,phone_number,'.$user->id,
           // 'city'          => 'max:35|regex:/^[\pL\s\-]+$/u',
            'city'          => 'max:35',
            'pin_code'      => 'string|max:150|alpha_num',
            'email'         => 'email|max:50|unique:users,email,'.$user->id
        ];
        $message = [

            'name.required'             => 'Please enter name',
            'profile_image.required'    => 'Please upload image',
            //'country_code.required'     => 'Please enter country code',
            'phone_number.required'     => 'Please enter phone number',
            'city.required'             => 'Please enter city name',
            'city.regex'                => 'The city should be enter in characters only',
            'pin_code.required'         => 'Please enter pin code',
            'email.required'            => 'Please enter email address'
        ];


        return $data = ['validation' => $validation, 'message' => $message];
    }


    public static function validationOnRule3($validation="", $message = ""){
      
        $validation = [
            'email'         => 'required|email|max:50|exists:users,email'
        ];
        $message = [
            'email.required'            => 'Please enter email address',
            'email.exists'              => 'Email address is not registered with us.'
        ];


        return $data = ['validation' => $validation, 'message' => $message];
    }


    public static function validationOnRuleUserAdd($validation="", $message = ""){
        $validation = [
            'name'          => 'required|max:20',
            'country_code'  => 'required',
            'phone_number'  => 'required|numeric|digits_between:8,15|unique:users',
            'city'          => 'required|max:30|regex:/^[\pL\s\-]+$/u',
            'pin_code'      => 'required|string|max:150|alpha_num',
            'device_type'   => 'required|in:None',
            'device_token'  => 'required',
            'email'         => 'required|email|max:50|unique:users',
            'password'      => 'required|max:50|min:6',
            'image_upload'  => 'required'

        ];
        $message = [

            'name.required'             => 'Please enter name',
            'profile_image.required'    => 'Please upload image',
            'country_code.required'     => 'Please enter country code',
            'phone_number.required'     => 'Please enter phone number',
            'city.required'             => 'Please enter city name',
            'city.regex'                => 'The city should be enter in characters only',
            'pin_code.required'         => 'Please enter pin code',
            'device_type.required'      => 'Please enter device type',
            'device_token.required'     => 'Please enter device token',
            'email.required'            => 'Please enter email address',
            'password.required'         => 'Please enter password',
            'image_upload.required'              => 'Please upload image'
        ];


        return $data = ['validation' => $validation, 'message' => $message];
    }

   
    // public function messages()
    // {
    //     return $this->hasMany(ChatRoom::class, 'receiver_user_id');
    // }

public function chatroom() {
    return $this->hasMany('App\Models\ChatRoom', 'receiver_user_id');
}

}
