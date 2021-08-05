<?php

namespace App\Http\Controllers\Api\v1;

use DB;
use Mail;
use Hash;
use Validator;
use GuzzleHttp;
use Carbon\Carbon;
use App\Models\Property;
use App\Models\User;
use App\Models\Admin;
use App\Models\Interested;
use App\Models\PropertyImages;
use App\Models\Favourite;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\v1\ResponseController;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\BusinessModel\PropertyModel;
use App\Models\Subscription;

use App\Mail\AddFavourite;
use App\Models\ChatRoom;

date_default_timezone_set('UTC');

class ApiController extends ResponseController
{

    private function PropertyModel(){
        return new PropertyModel();
    }

    public function getAdmin(){
        $user = Admin::first();
        return response()->json(["message" => "Admin data get successfully.","data" => $user]);
    }

    public static function uploadProfile($destinationPath,$image){
        $imageName = date('mdY') . uniqid().'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        return $imageName;
    }


    public  function addProperty(Request $request) {
        $user_id = Auth::id();
        $message = [
            'profile.required'            => 'Please upload image',
            'property_type.required'      => 'Please enter property type',
            'property_price.required'     => 'Please enter property price',
            'number_of_bedroom.required'  => 'Please enter number of bedroom',
            'number_of_bathroom.regex'    => 'Please enter number of bathroom',
            'date.required'               => 'Please enter date',
            'start_time.required'         => 'Please enter start time',
            'end_time.required'           => 'Please enter end time',
            'description.required'        => 'Please enter description',
            'address.required'            => 'Please enter address'
       ];
       $validator = Validator::make($request->all(), [
            'profile.*'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'property_type'      => 'required',
            'property_price'     => 'required',
            'number_of_bedroom'  => 'required',
            'number_of_bathroom' => 'required',
            'tax'                => 'nullable',
            'plot_size'          => 'nullable',
            'building_size'      => 'nullable',
            'school_district'    => 'nullable',
            'date'               => 'required',
            'start_time'         => 'required',
            'end_time'           => 'required',
            'description'        => 'required',
            'address'            => 'required',

        ], $message);

        $status = 1;   
        $data = [
            'user_id'            => $user_id,
            'property_type'      => $request->property_type,
            'property_price'     => $request->property_price,
            'number_of_bedroom'  => $request->number_of_bedroom,
            'number_of_bathroom' => $request->number_of_bathroom,
            'tax'                => $request->tax,
            'plot_size'          => $request->plot_size,
            'building_size'      => $request->building_size,
            'school_district'    => $request->school_district,
            'date'               => $request->date,
            'start_time'         => $request->start_time,
            'end_time'           => $request->end_time,
            'description'        => $request->description,
            'address'            => $request->address,
            'status'             => $status,
            'longitude'          => $request->longitude,
            'latitude'           => $request->latitude,
            'type'               => 'user'
         ];

          if($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()],400); 
        }
        
        $data = $this->PropertyModel()->createProperty($data);

        if($data) {
          $profile = $request->hasfile('profile');
            if($profile) {
                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . "app/public/property_images";
                foreach ($request->file("profile") as $image) {
                    $image_name = self::uploadProfile($destinationPath,$image);     
                    $create_array = ["property_id" => $data->id, "profile" => $image_name,'user_id'=>$data->user_id,'type'               =>'user'];
                    PropertyImages::create($create_array);
                }
            }
        }

        return response()->json(["message" => "Property added successfully."]);
    }

    
    public  function updateProperty(Request $request){
        $user_id = Auth::id();
        $message = [
            'profile.required'            => 'Please upload image',
            'property_type.required'      => 'Please enter property type',
            'property_price.required'     => 'Please enter property price',
            'number_of_bedroom.required'  => 'Please enter number of bedroom',
            'number_of_bathroom.regex'    => 'Please enter number of bathroom',
            'date.required'               => 'Please enter date',
            'start_time.required'         => 'Please enter start time',
            'end_time.required'           => 'Please enter end time',
            'description.required'        => 'Please enter description',
            'address.required'            => 'Please enter address'
       ];
       $validator = Validator::make($request->all(), [
            'profile.*'          => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            'property_type'      => 'required',
            'property_price'     => 'required',
            'number_of_bedroom'  => 'required',
            'number_of_bathroom' => 'required',
            'tax'                => 'nullable',
            'plot_size'          => 'nullable',
            'building_size'      => 'nullable',
            'school_district'    => 'nullable',
            'date'               => 'required',
            'start_time'         => 'required',
            'end_time'           => 'required',
            'description'        => 'required',
            'address'            => 'required',

        ], $message);

         $data = [
            'user_id'            => $user_id,
            'property_type'      => $request->property_type,
            'property_price'     => $request->property_price,
            'number_of_bedroom'  => $request->number_of_bedroom,
            'number_of_bathroom' => $request->number_of_bathroom,
            'tax'                => $request->tax,
            'plot_size'          => $request->plot_size,
            'building_size'      => $request->building_size,
            'school_district'    => $request->school_district,
            'date'               => $request->date,
            'start_time'         => $request->start_time,
            'end_time'           => $request->end_time,
            'description'        => $request->description,
            'address'            => $request->address,
            'longitude'          => $request->longitude,
            'latitude'           => $request->latitude,
            'type'               => 'user',
         ];

        if($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()],400); 
        }

        $where = ['user_id'=>$user_id,'id'=>$request->property_id];
        $data = $this->PropertyModel()->updateProperty($where,$data);

        if($data) {
            $profile = $request->hasfile('profile');       
            if($profile) {
                $delete_images = PropertyImages::where(['user_id'=>$user_id,'property_id'=>$request->property_id])->delete(); 
                $destinationPath = storage_path(). DIRECTORY_SEPARATOR . "app/public/property_images";
                foreach ($request->file("profile") as $image) {
                    $image_name = self::uploadProfile($destinationPath,$image);     
                    PropertyImages::create(['user_id'=>$user_id,'property_id'=>$request->property_id,'profile'=>$image_name,'type'=>'user']);
                }
            }
        }
        return response()->json(["message" => "Property updated successfully."]);
    }

    public function getProperty(Request $request) {
        $user_id = Auth::id();
        $property_type = $request->input('property_type');
        $property_start_price = $request->input('property_start_price');
        if($property_start_price == "0"){
            $property_start_price = "1";
        } else {
            $property_start_price = $request->input('property_start_price');
        }

        $number_of_bedroom = $request->input('number_of_bedroom');
        $number_of_bathroom = $request->input('number_of_bathroom');
        $property_end_price = $request->input('property_end_price');
        $search_key = $request->input('search_key');
        $date = $request->input('date');
        
        $data = $this->PropertyModel()->getProperty($user_id,$property_type,$property_start_price,$property_end_price,$number_of_bedroom,$number_of_bathroom,$date,$search_key);
        return response()->json(["message" => "Property list get successfully.","data" => $data]);
    }
   
    
    public function propertyListLatLng(Request $request) {
        $user_id = Auth::id();
        $lng = $request->input('longitude');
        $lat = $request->input('latitude');
        $miles = $request->input('miles');
        if($miles == "0"){
          return response()->json(["message" => "No data found."]); 
        }

        if($miles){
          $miles = $request->input('miles');
        } else {
          $miles = 50;
        }

        $property_type = $request->input('property_type');
        $property_start_price = $request->input('property_start_price');
        
        if($property_start_price == "0"){
            $property_start_price = "1";
        } else {
            $property_start_price = $request->input('property_start_price');
        }

        $number_of_bedroom = $request->input('number_of_bedroom');
        $number_of_bathroom = $request->input('number_of_bathroom');
        $property_end_price = $request->input('property_end_price');
        $search_key = $request->input('search_key');
        $date = $request->input('date');
    
        $data = $this->PropertyModel()->getPropertyLatLng($user_id,$property_type,$property_start_price,$property_end_price,$number_of_bedroom,$number_of_bathroom,$date,$search_key,$lat,$lng,$miles);

        return response()->json(["message" => "Property list get successfully.","data" => $data]);
    }
     
   
    
    public function myPropertyList() {
        $user_id = Auth::id();
        $where = ["user_id" => $user_id];
        $data = $this->PropertyModel()->myPropertyList($where,$user_id);
        return response()->json(["message" => "My property list get successfully.","data" => $data]);
    }
     
    public function pastPropertyList(Request $request){
        $type  = $request->input('type');
        if($type == "admin"){
            $date = date("Y-m-d");
            $data =  Property::where('status','2')->with('Images')
                        ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where  is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where  going = '1')) THEN 1 ELSE 0 END) as going"))
                        ->orderBy("id","desc")
                        ->where(['properties.type'=>'admin'])
                        ->where('properties.date','<', $date)
                        ->get();
            return response()->json(["message" => "My property list get successfully.","data" => $data]);
        }

        $user_id = $request->input('user_id');
        $where = ["user_id" => $user_id];
        $data = $this->PropertyModel()->pastPropertyList($where,$user_id);
        return response()->json(["message" => "My property list get successfully.","data" => $data]);
    }
   
    public function upcomingPropertyList(Request $request){
        $type  = $request->input('type');
        if($type == "admin"){
            $date = date("Y-m-d");
            $data = Property::where('status','2')->with('Images')
                                ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where  is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"),DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from interesteds where  going = '1')) THEN 1 ELSE 0 END) as going"))
                                ->where(['properties.type'=>'admin'])
                                ->where('properties.date','>=', $date)
                                ->orderBy("id","desc")
                                ->get();
            return response()->json(["message" => "My property list get successfully.","data" => $data]);
        } 

        $user_id = $request->input('user_id');
        $where = ["user_id" => $user_id];
        $data = $this->PropertyModel()->upcomingPropertyList($where,$user_id);
        return response()->json(["message" => "My property list get successfully.","data" => $data]);
    }

    public  function addFavourite(Request $request) {
        $user_id = Auth::id();
        $interest_user_name = User::where("id" , $user_id)->select("name")->first();
        $message = [
            'is_favourite.required'    => 'Please enter isfavorite',
            'property_id.required'     => 'Please enter property id',    
        ];

        $validator = Validator::make($request->all(), [
            'property_id'   => 'required',
            'is_favourite'  => 'required|in:1,2',    
        ], $message);
        
        $data = [
            'user_id'      => $user_id,
            'property_id'  => $request->property_id,
            'is_favourite' => $request->is_favourite
        ];

        if($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()],400); 
        }

        if($request->is_favourite == 1){
            $data = $this->PropertyModel()->addFavourite($data);

            $property_id = $data->property_id;
            $property_detail = Property::where("id",$property_id)->first();
            $user_detail = User::where("id" , $property_detail->user_id)->first();

            
            //Notification
            // $message = "Someone has been interested in your property.";
            // $notfy_key=3;
            // $notfy_message = array('sound' =>1,'message'=>$message,'notifykey'=>'3');
            // if($user_detail->device_type == 'android'){
            //      $t = $this->android($user_detail->device_token,$message,$notfy_key,$notfy_message);
            // }elseif($user_detail->device_type == 'Ios'){
            //   $this->send_iphone_notification($user_detail->device_token,$message,$notfy_key,$notfy_message);
            // }
            // $save_notf =[
            //             "user_id" => $user_detail->id,
            //             "message" => $message,
            //             "notify_message" =>  $notfy_key,
            //             "property_id" => $request->property_id,
            //             ];
            // DB::table('notifications')->insertGetId($save_notf);


            //Email
            // $property_owner_name = $user_detail->name;
            // try{
            //     \Mail::to($user_detail->email)->send(new AddFavourite($property_owner_name ,$interest_user_name ));
            // }catch(\Exception $ex){
            //     return $ex->getMessage();
            //     return back()->with("error" , "Unable to proceed your request, Please try later.");
            // }

            return response()->json(["message" => "Favourite successfully."]);
        } else {
            $where = ["user_id" => $user_id,'property_id' => $request->property_id];
            $data = $this->PropertyModel()->updateFavourite($where);
            return response()->json(["message" => "Unfavourite successfully."]);
        }  
    }
    
    public function getFavouriteList() {
        $user = Auth::user();
        $where = ["user_id" => $user->id,'is_favourite' => 1];
        $data = $this->PropertyModel()->getFavouriteList($where,$user->id);
        $user->favourite_property = $data;
        return response()->json(["message" => "Favourite property list get successfully.","data" => $user]);
    }

    public function getInterestedList(Request $request) {
        $user = Auth::user();
        $message = [
            'property_id.required'     => 'Please enter property id',    
        ];

        $validator = Validator::make($request->all(), [
            'property_id'   => 'required',     
        ], $message);

        $where = ["property_id" => $request->property_id];

        $property_detail = Property::with('Images')->where('id',$request->property_id)->first();
        $data = $this->PropertyModel()->getInterestedList($where);
        $property_detail->interested_user = $data;
        return response()->json(["message" => "Interested User list get successfully.","data" => $property_detail]);
    }

    public function addInterested(Request $request) {
        $user = Auth::user();
        $message = [
            'going.required'         => 'Please enter going',
            'property_id.required'   => 'Please enter property id',   
        ];

        $validator = Validator::make($request->all(), [
            'property_id'   => 'required',
            'going'         => 'required|in:1,0',
        ], $message);
        
        $data = [
            'user_id'      => $user->id,
            'property_id'  => $request->property_id,
            'going'        => $request->going
        ];

        if($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()],400); 
        }
        
        $where = ['property_id'=>$request->property_id,'user_id'=>$user->id];

        $get_interested = Interested::where($where)->first();
        if(!empty($get_interested)) {
            $update_interested = $this->PropertyModel()->updateInterested($where,$data);
            return response()->json(["message" => "UnInterested successfully."]);
        }

        $data = $this->PropertyModel()->addInterested($data);
        $get_property = property::where('id',$data->property_id)->first();

        if($get_property) {   
            $message = $user->name . " interested your property";
            $notificationMessage = "interested your property";
            $insertNotification = Notification::insert(['other_user_id' => $get_property->user_id, 'user_id' => $user->id, 'message' => $message, 'notify_message' => $notificationMessage,'property_id' => $data->property_id,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]);
            
            $notifyMessage = array(
                'sound' => 1,
                'message' => $message,
                'id' => $user->id
            );

            $message_new = array('sound' =>1,'message' => $message,'notifykey' => 'property interested','id' => $user->id);


            //Notification
            // $user_data = User::where("id" , $get_property->user_id)->get();

            // if (!empty($user_data->device_type) && !empty($user_data->device_token))
            // {
            //     if ($user_data->device_type == 'Android')
            //     {
            //         $this->send_android_notification($user_data->device_token,"Some one has been interested in your property" ,$message_new);
            //     }
            //     else
            //     {
            //         $this->send_iphone_notification($user_data->device_token, $message, $notmessage ="Some one has been interested in your property", $notifyMessage);
            //     }
            // }


            //Email
            $property_owner_detail = User::where("id" , $get_property->user_id)->first();
            $property_owner_name = $property_owner_detail->name;
            $interest_user_name = $user->name;
            try{
                \Mail::to($property_owner_detail->email)->send(new AddFavourite($property_owner_name ,$interest_user_name ));
            }catch(\Exception $ex){
                return $ex->getMessage();
                return back()->with("error" , "Unable to proceed your request, Please try later.");
            }

        }
        return response()->json(["message" => "Interested successfully."]);
    }


    public function notificationList() {
        $user = Auth::user();
        $data = $this->PropertyModel()->getNotificationList($user);
        return response()->json(["message" => "Notification list get successfully.","data" => $data]);
    }
    

    public function notificationDetail(Request $request){
         $message = [
            'property_id.required'     => 'Please enter property id',     
        ];

        $validator = Validator::make($request->all(), [
            'property_id'   => 'required',   
        ], $message);

        $property_id = $request->input('property_id');

        $data = Property::where("id" , $property_id)->with("Images")->get();

        return response()->json(["message" => "Property detail get successfully." , "data"=>$data]);
    }


    public function uploadPropertyImage(Request $request) {
        $user = Auth::user();
        $message = [
            'property_id.required'     => 'Please enter property id',    
            'image.required'     => 'Please select image',    
        ];

        $validator = Validator::make($request->all(), [
            'property_id'   => 'required',
            'image'         => 'required'     
        ], $message);

        $image = $request->hasfile('image');
        if($image) {
            $destinationPath = storage_path(). DIRECTORY_SEPARATOR . "app/public/property_images";
            $image_name = self::uploadProfile($destinationPath,$request->file('image'));

            $create_array = [
                "property_id" => $request->property_id, 
                "profile" => $image_name,
                'user_id' => $user->id,
                'type' => 'user'
            ];
            PropertyImages::create($create_array);
        }

        $property_detail = Property::with('Images')->where('id',$request->property_id)->first();
        return response()->json(["message" => "Image has been uploaded successfully.","data" => $property_detail]);
    }

    public function deletePropertyImage(Request $request) {
        if($request->image_id) {
            $where = ["id" => $request->image_id];
            $deletePropertyImage = PropertyImages::where($where)->delete();
            return response()->json(["message" => "Property image deleted successfully."]);
        } else {
            return response()->json(["message" => "Please enter image id"],400);
        }
    }



    public function userInterestInProperty() {
        $user = Auth::user();

        $owner_property = Property::where("user_id" , $user->id)->pluck("id");
        $interested_user = Interested::whereIn("property_id" ,$owner_property)->pluck("user_id");

        $user_detail = User::whereIn("id",$interested_user)->get();

        foreach ($user_detail as $key => $value) {
            $interesteds = Interested::where('interesteds.user_id',$value->id)
                                    ->pluck('property_id');
            if($interesteds) {
                $value->properties =  Property::whereIn('id',$interesteds)->with('Images')
                                    ->select("properties.*",DB::raw("(CASE WHEN FIND_IN_SET(properties.id,(select group_concat(property_id) from favourites where user_id = ".$user->id." and is_favourite = '1')) THEN 1 ELSE 0 END) as is_favourite"))->get();
            }
        }   

        return response()->json(["message" => "Intrested users in property list get successfully.","data" => $user_detail]);
    }


    // public function intrestedUsersDetail(Request $request){
    //     // return $request->user_id;
    //     $user_id = $request->input('user_id');
    //     $property_id = $request->input('property_id');

    //     $user_detail = User::where("id" , $user_id)->first();
    //     $property_detail = Property::where("id" , $property_id)->first();

    //    // return  $property = Property::where("user_id" , $user_id)->with('favourites')->paginate(10);
    //     return response()->json(["message" => "Details get successfully." , "user_detail"=>$user_detail  , "property_detail"=>$property_detail]);
    // }





    public  function addSubscription(Request $request) {
        $user_id = Auth::id();
        $message = [
            'subscription_type.required'      => 'Please enter subscription type.',
            'subscription_start_date.required'     => 'Please enter subscription start date.',
            'transaction_id.required'  => 'Please enter subscription transaction id.',
       ];
       $validator = Validator::make($request->all(), [
            'subscription_type'      => 'required',
            'subscription_start_date'     => 'required',
            'transaction_id'  => 'required',
            
        ], $message);

        $data = [
            'user_id'       => $user_id,
            'subscription_type'      => $request->subscription_type,
            'subscription_start_date'     => $request->subscription_start_date,
            'transaction_id'  => $request->transaction_id,
           
         ];

          if($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()],400); 
        }

        $already_purchased = Subscription::where("user_id"  ,$user_id)->first();


        if($already_purchased){

            if($already_purchased->subscription_type == "monthly"){
                $date_purchased = $already_purchased->subscription_start_date;
                $subscription_end_date = date('Y/m/d', strtotime($date_purchased. ' + 30 days'));
                $present_date = date("Y-m-d ");
                
                if(strtotime($subscription_end_date) > strtotime($present_date)){
                     return response()->json(["message" => "You have already buy subscription of monthly plan."]);
                }else{
                   Subscription::where("user_id" , $user_id)->update($data);
                    return response()->json(["message" => "Subscribed successfully."]);
                }
            }

            if($already_purchased->subscription_type == "yearly"){
                $date_purchased = $already_purchased->subscription_start_date;
                $subscription_end_date = date('Y-m-d', strtotime($date_purchased. ' + 365 days'));
                $present_date = date("Y-m-d ");

                if(strtotime($subscription_end_date)  > strtotime($present_date)){
                    return response()->json(["message" => "You have already buy subscription of yearly plan."]);
                }else{
                    Subscription::where("user_id" , $user_id)->update($data);
                    return response()->json(["message" => "Subscribed successfully."]);
                }
            }

        }

        else{
            $detail = Subscription::create($data);
            return response()->json(["message" => "Subscribed successfully."  , "data" =>$detail] );
        }

    }


    public function changePassword(Request $request) {
        $user = Auth::user();

        $message = [
            'old_password.required'    => 'Please enter old password.',
            'new_password.required'    => 'Please enter new password.',
            'confirm_password.required'=> 'Please enter comfirm password.',
            'confirm_password.same'    => "Password and confirm password does not match."
        ];

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',   
            'new_password' => 'required',   
            'confirm_password'  => 'required|required_with:new_password|same:new_password'
        ], $message);

        if($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()],400); 
        } 

        $data = [
            'password'    => Hash::make($request->new_password),
        ];

        $old_password = $request->old_password;

        if(Hash::check($old_password,$user->password)) {
            $is_updated = User::where("id" , $user->id)->update($data);
            return response()->json(["message" => "Password has been changed successfully."]);
        } else {
            return response()->json(["message" => "Please enter valid old password."],406);
        }
    }




    public function sendChatMessage(Request $request){
        $user_id = Auth::id();
        $message = [
            'receiver_id.required'  => 'Please select user',
            'message.required'      => 'Please enter message',
       ];

       $validator = Validator::make($request->all(), [
            'receiver_id'        => 'required',
            'message'            => 'required',
        ], $message);

        if($validator->fails()) {
            return response()->json(["message" => $validator->errors()->first()],400); 
        }    
        $saveData = [
            "sender_user_id" => $user_id,
            "receiver_user_id" => $request->get("receiver_id"),
            "message" => $request->get("message")
        ];

        $isSaved = ChatRoom::create($saveData);

        if($isSaved){
                return response()->json(["message" => "Message sent successfully."]);
        } 
        else {
            return response()->json(["message" => "Failed to send message."],406);
        }
    }


    public function receiverMessageDetail(Request $request)
    {


        // Sended data from html form 
            $to      = $request->to;
            $from    = Auth::user()->id;
            $message = $request->message;


            // $receiver_user_id = User::where('id', $receiver_id)->first();  

             // Send message
           ChatRoom::create(
                [
                    
                    'message'=>$message, 
                    'from'=>$from, 
                    'to'=>$receiver_user_id
                ]
            );

    }


 }