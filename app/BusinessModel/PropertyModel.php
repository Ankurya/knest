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
use App\Models\Property;
use App\Models\PropertyImages;
use App\Models\Favourite;
use App\Models\Interested;
use App\Models\Notification;



class PropertyModel extends Model
{

     public static function getSingleProperty(array $where){
        return Property::with('Images','Users')
              ->where($where)->first();
    }
    public static function createProperty(array $data){
        return Property::create($data);
    }
    
     public static function updateProperty(array $where , array $data){
        return Property::where($where)->update($data);
    }


     
     public function getProperty($user_id,$property_type,$property_start_price,$property_end_price,$number_of_bedroom,$number_of_bathroom,$date,$search_key){
        $data =  Property::where('status','2')->with('Images','Users')
                ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where user_id = ".$user_id." and is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where user_id = ".$user_id." and going = '1')) THEN 1 ELSE 0 END) as going"));
    if($property_type){
      $data = $data->where(function($query) use($property_type){
        return $query->where('property_type','like',"%".$property_type."%");
      });          
    }

    if($property_start_price && $property_end_price){
        
         $data = $data->Where(function($query) use($property_start_price,$property_end_price) {
          return $query->WhereBetween('property_price',[$property_start_price,$property_end_price]);
        });
        }   



        if(strlen($number_of_bathroom) > 0){
            if((int)$number_of_bathroom == 0){
                $data = $data->where(function($query) use($number_of_bathroom) {
                    return $query->Where('number_of_bathroom','=',$number_of_bathroom);
                });
            }else {
                $data = $data->where(function($query) use($number_of_bathroom) {
                    return $query->Where('number_of_bathroom','<=',$number_of_bathroom);
                });             
            }
        }


        if(strlen($number_of_bedroom) > 0){
            if((int)$number_of_bedroom == 0){
                $data = $data->where(function($query) use($number_of_bedroom) {
                    return $query->Where('number_of_bedroom','=',$number_of_bedroom);
                });
            }else {
                $data = $data->where(function($query) use($number_of_bedroom) {
                    return $query->Where('number_of_bedroom','<=',$number_of_bedroom);
                });             
            }
        }

    if($date){
      $dates = explode(',',$date);
      $data = $data->where(function($query) use($dates) {
        return $query->whereIn('date',$dates);
      });          
    }

    if($search_key){
      $data = $data->where(function($query) use($search_key) {
        return $query->orWhere('address','like',"%".$search_key."%");
      });          
    }
        return $data->orderBy("id","desc")->paginate(10);
    }

      public function getPropertyLatLng($user_id,$property_type,$property_start_price,$property_end_price,$number_of_bedroom,$number_of_bathroom,$date,$search_key,$lat,$lng,$miles){
        $data = Property::where('status','2')->with('Images','Users')
                ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where user_id = ".$user_id." and is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where user_id = ".$user_id." and going = '1')) THEN 1 ELSE 0 END) as going"))
                ->orderBy("id","desc");
                
         $query_distance = '(6367 * acos( cos( radians("'.$lat.'") ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians("'.$lng.'") ) + sin( radians("'.$lat.'") ) * sin( radians( latitude ) ) ) )';
          $data =  $data->where(DB::raw($query_distance),'<=',$miles)
              ->orderBy('distance','ASC')
              ->addSelect(DB::raw(($query_distance) .' AS distance'));

    if($property_type){
      $data = $data->where(function($query) use($property_type){
        return $query->where('property_type','like',"%".$property_type."%");
      });          
    }

    if($property_start_price && $property_end_price){
        
         $data = $data->Where(function($query) use($property_start_price,$property_end_price) {
          return $query->WhereBetween('property_price',[$property_start_price,$property_end_price]);
        });
        }   



        if(strlen($number_of_bathroom) > 0){
            if((int)$number_of_bathroom == 0){
                $data = $data->where(function($query) use($number_of_bathroom) {
                    return $query->Where('number_of_bathroom','=',$number_of_bathroom);
                });
            }else {
                $data = $data->where(function($query) use($number_of_bathroom) {
                    return $query->Where('number_of_bathroom','<=',$number_of_bathroom);
                });             
            }
        }


        if(strlen($number_of_bedroom) > 0){
            if((int)$number_of_bedroom == 0){
                $data = $data->where(function($query) use($number_of_bedroom) {
                    return $query->Where('number_of_bedroom','=',$number_of_bedroom);
                });
            }else {
                $data = $data->where(function($query) use($number_of_bedroom) {
                    return $query->Where('number_of_bedroom','<=',$number_of_bedroom);
                });             
            }
        }

    if($date){
      $dates = explode(',',$date);
      $data = $data->where(function($query) use($dates) {
        return $query->whereIn('date',$dates);
      });          
    }

    if($search_key){
      $data = $data->where(function($query) use($search_key) {
        return $query->orWhere('address','like',"%".$search_key."%");
      });          
    }
        return $data->orderBy("id","desc")->get();
    }

    public function pastPropertyList(array $where,$user_id){
         $date = date("Y-m-d");
         return Property::where($where)
                ->with('Images')
                ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where user_id = ".$user_id." and is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where user_id = ".$user_id." and going = '1')) THEN 1 ELSE 0 END) as going"))
                ->orderBy("id","desc")
                ->where('properties.date','<', $date)
                ->where('properties.status','2')
                ->get();
    }
    
    public function upcomingPropertyList(array $where,$user_id){
         $date = date("Y-m-d");
         return Property::where($where)
                ->with('Images')
                 ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where user_id = ".$user_id." and is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where user_id = ".$user_id." and going = '1')) THEN 1 ELSE 0 END) as going"))
                ->orderBy("id","desc")
               ->where('properties.date','>=', $date)
               ->where('properties.status','2')
                ->get();
    }


    public function myPropertyList(array $where,$user_id){
         return Property::where($where)
                ->with('Images') 
                 ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where user_id = ".$user_id." and is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where user_id = ".$user_id." and going = '1')) THEN 1 ELSE 0 END) as going"))
                ->orderBy("id","desc")
                ->where('properties.status','2')
                ->get();
    }


    public static function addFavourite(array $data){
        return Favourite::create($data);
    }

    public static function addInterested(array $data){
        return Interested::create($data);
    }
  
  public static function updateInterested(array $where, array $data){
        return Interested::where($where)->update($data);
    }
    

    public static function updateFavourite(array $where){
        return Favourite::where($where)->update(['is_favourite'=>2]);
    }

    /*public function getFavouriteList(array $where){
         $favouriteList = Favourite::where($where)->pluck('property_id');
         return Property::whereIn('id',$favouriteList)->with('Images','Users')
                ->orderBy("id","desc")
                ->get();
    }*/


      public function getFavouriteList(array $where,$user_id){
         $favouriteList = Favourite::where($where)->pluck('property_id');
             return Property::whereIn('id',$favouriteList)
                ->with('Images','Users')
                 ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where user_id = ".$user_id." and is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where user_id = ".$user_id." and going = '1')) THEN 1 ELSE 0 END) as going"))
                ->orderBy("id","desc")
                ->get();
    }
  
     public function getInterestedList(array $where){
         $InterestedList = Interested::where($where)->pluck('user_id');
         return User::whereIn('id',$InterestedList)
                ->orderBy("id","desc")
                ->get();
    }

    public function getNotificationList($user){
        return  $favouriteList = Notification::where('other_user_id',$user->id)
                 // ->orwhere('user_id',$user->id)
                 ->orderBy("id","desc")
                 ->get();
    }


 public static function send_android_notification($device_token,$message,$notmessage='',$msgsender_id=''){
    if (!defined('API_ACCESS_KEY'))
    {
      define('API_ACCESS_KEY','AAAAw_qk_lI:APA91bHb0bLFByFcj3gd8umTYG5QzOFLUVWkzXudN9xHAXl232plDra86kXHohP-vAq27SM1mYT4q-FuI4OQj135k1D6_XVjF6w3uHZaFJxvR4tQO-Zi725juBHnBMB_jDWOm4eC5VMy');
    }
    $registrationIds = array($device_token);
    $fields = array(
      'registration_ids' => $registrationIds,
      'alert' => $message,
      'sound' => 'default',
      'Notifykey' => $notmessage, 
      'data'=>$msgsender_id
        
    );
    $headers = array(
      'Authorization: key=' . API_ACCESS_KEY,
      'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields) );
    $result = curl_exec($ch);

    if($result == FALSE) {
      die('Curl failed: ' . curl_error($ch));
    }

    curl_close( $ch );
    return  $result;
  }

  public static function send_iphone_notification($recivertok_id,$message,$notmessage='',$notfy_message){
    //$PATH = dirname(dirname(dirname(dirname(__FILE__))))."/pemfile/lens_development_push.pem";
    $PATH = dirname(dirname(dirname(dirname(__FILE__))))."/pemfile/apns-prod.pem";
    $deviceToken = $recivertok_id;  
    $passphrase = "";
    $message = $message;  
    $ctx = stream_context_create();
         stream_context_set_option($ctx, 'ssl', 'local_cert', $PATH);
         stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
    
      $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err,
    $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); 
       
      /*$fp = stream_socket_client(
                 'ssl://gateway.push.apple.com:2195', $err,
     $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); 
      */
    $body['message'] = $message;
    $body['post_id'] = $notfy_message;
    $body['Notifykey'] = $notmessage;
            if (!$fp)
                 exit("Failed to connect: $err $errstr" . PHP_EOL);

        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default',
            'details'=>$body
        );
           
    $payload = json_encode($body);
    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
    $result = fwrite($fp, $msg, strlen($msg));

    //echo "<pre>";
    // print_r($result);
    // if (!$result)
      // echo 'Message not delivered' . PHP_EOL;
    // else
      // echo 'Message successfully delivered' . PHP_EOL;
    // exit;
    fclose($fp);
    return $result;
    die;
  }


}