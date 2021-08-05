<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;
use App\Models\Admin;
use Auth;
use App\Models\Interested;
use App\Models\PropertyImages;

use App\Models\Favourite;
use App\Models\Notification;
use Session;
use App\BusinessModel\PropertyModel;
use App\Http\Controllers\Controller;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
class PropertyController extends Controller
{
    private function PropertyModel(){
    return new PropertyModel();
    }

    public function property(Request $request){
    	if($request->isMethod('GET')){
             $property = Property::where('status','2')->with('Users')->orderBy('id','desc')->get();
    		return view('admin.pages.property-management.property',compact('property'));
    	}
    }


    public function addProperty(Request $request){
    	if($request->isMethod('GET')){
    		return view('admin.pages.property-management.add-property');
    	}

    	if($request->isMethod("POST")){
            //return $request->all();
            $message = [
            //'profile.required'            => 'Please upload image',
            'property_type.required'      => 'Please select property type.',
            'property_price.required'     => 'Please enter property price.',
            'number_of_bedroom.required'  => 'Please enter number of bedroom.',
            'number_of_bathroom.required' => 'Please enter number of bathroom.',
            'date.required'               => 'Please select date.',
            'start_time.required'         => 'Please select start time.',
            'end_time.required'           => 'Please select end time.',
            'description.required'        => 'Please enter description.',
            'address.required'            => 'Please enter address.'
            ];

             $this->validate($request, [
            // 'profile.*'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
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

            ],$message);

            $status = 2;
            //return $request;
            $data = [
           // 'user_id'            =>$admin_id,
            'property_type'      =>$request->property_type,
            'property_price'     =>$request->property_price,
            'number_of_bedroom'  =>$request->number_of_bedroom,
            'number_of_bathroom' =>$request->number_of_bathroom,
            'tax'                =>$request->tax,
            'plot_size'          =>$request->plot_size,
            'building_size'      =>$request->building_size,
            'school_district'    =>$request->school_district,
            'date'               =>$request->date,
            'start_time'         =>$request->start_time,
            'end_time'           =>$request->end_time,
            'description'        =>$request->description,
            'address'            =>$request->address,
            'status'             => $status,
            'latitude'         =>$request->lat,
            'longitude'         =>$request->long,
            'type'               =>'admin'
            ];
             $is_created = PropertyModel::createProperty($data);
            //$user_id = Auth::guard("user")->id();
            $property_id = $is_created->id;


            $images = $this->parseFiles($request,"images");
                if($images){
                    $all_media = array();
                    $len = count($images);
                    $j = 1; 
                    if($len > 0){
                        $j = 0;
                        for($i = 0;$i < $len;$i++){
                            if(isset($images[$i])){
                                $cnt_img = count($images[$i]);
                                for($k = 0; $k < $cnt_img;$k++){
                                    $file = $this->multipleImageUpload($images[$i][$k],"/app/public/property_images", 1);
                                    $insert_data = array();
                                   // $insert_data["user_id"] = $admin_id;
                                    $insert_data["property_id"] = $property_id;
                                    $insert_data["profile"] = $file;
                                    $insert_data["type"] = "admin";
                                    PropertyImages::create($insert_data);
                                }             
                            }
                        } 
                    }
                }
            }
             if($is_created){
                Session::flash('message','Property has been added successfully.');
                return redirect('admin/property');
            }else{
                Session::flash('danger', 'Unable to proceed your request, Please try later.');
                return back(); 
            }
        }


    public function editProperty(Request $request){
    	if($request->isMethod('GET')){
             $id = base64_decode($request->id);
             $where = ['id'=>$id];
             $property_find = $this->PropertyModel()->getSingleProperty($where);
             $profile =PropertyImages::where(['property_id'=>$id])->get();
    		return view('admin.pages.property-management.edit-property',compact('property_find','profile'));
    	}

    	if($request->isMethod("POST")){
           
            $message = [
            //'profile.required'            => 'Please upload image',
            'property_type.required'      => 'Please select property type.',
            'property_price.required'     => 'Please enter property price.',
            'number_of_bedroom.required'  => 'Please enter number of bedroom.',
            'number_of_bathroom.required' => 'Please enter number of bathroom.',
            'date.required'               => 'Please select date.',
            'start_time.required'         => 'Please select start time.',
            'end_time.required'           => 'Please select end time.',
            'description.required'        => 'Please enter description.',
            'address.required'            => 'Please enter address.'
            ];

             $this->validate($request, [
            // 'profile.*'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20480',
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

            ],$message);

             $id = base64_decode($request->id);
             $where = ['id'=>$id];
             $property_find = $this->PropertyModel()->getSingleProperty($where);
              if(!empty($property_find->type == "user")){
                $type = $property_find->type; 
                $user_id = $property_find->user_id;    
              }else{
              $type = "admin";
              $user_id =(int)" ";  
              }  
              $data = [
          //  'user_id'            =>$admin_id,
            'property_type'      =>$request->property_type,
            'property_price'     =>$request->property_price,
            'number_of_bedroom'  =>$request->number_of_bedroom,
            'number_of_bathroom' =>$request->number_of_bathroom,
            'tax'                =>$request->tax,
            'plot_size'          =>$request->plot_size,
            'building_size'      =>$request->building_size,
            'school_district'    =>$request->school_district,
            'date'               =>$request->date,
            'start_time'         =>$request->start_time,
            'end_time'           =>$request->end_time,
            'description'        =>$request->description,
            'address'            =>$request->address,
            'latitude'         =>$request->lat,
            'longitude'         =>$request->long
           
            ];
            $where = ['id'=>$id];
            $data = PropertyModel::updateProperty($where,$data);
            $property_id = $id;
            $image_id = explode(",",$request->delete_images);
             PropertyImages::whereIn('id', $image_id)->delete();
              $images = $this->parseFiles($request,"images");
                if($images){
                    $all_media = array();
                    $len = count($images);
                    $j = 1; 
                    if($len > 0){
                        $j = 0;
                        for($i = 0;$i < $len;$i++){
                            if(isset($images[$i])){
                                $cnt_img = count($images[$i]);
                                for($k = 0; $k < $cnt_img;$k++){
                                    $file = $this->multipleImageUpload($images[$i][$k],"/app/public/property_images", 1);
                                    $insert_data = array();
                                    $insert_data["user_id"] = $user_id;
                                    $insert_data["property_id"] = $property_id;
                                    $insert_data["profile"] = $file;
                                    $insert_data["type"] = $type;
                                    PropertyImages::create($insert_data);
                                }             
                            }
                        } 
                    }
                }

            }
            if($data){
                Session::flash('message','Property has been updated successfully.');
                return redirect('admin/property');
            }else{
                Session::flash('error', 'Unable to proceed your request, Please try later.');
                return back(); 
            }
            
    }

     public function viewProperty(Request $request){
             $id = base64_decode($request->id);
             $where = ['id'=>$id];
             $property_find = $this->PropertyModel()->getSingleProperty($where);
             $profile =PropertyImages::where(['property_id'=>$id])->get();
    	return view('admin.pages.property-management.view-property',compact('property_find','profile'));
    }

      public function deleteProperty(Request $request){
        $id = $request->user_id;
        $where = ['id'=>$id];
        $property = Property::where($where)->delete();
        $property = PropertyImages::where(['property_id'=>$id])->delete();
        Session::flash('message','Property has been  deleted successfully.');
        return back();
    }


    public function newPropertyManagement(Request $request){
         $property = Property::where('status','1')->with('Users')->orderBy('id','desc')->get();
    	return view('admin.pages.property-management.new-property-management',compact('property'));
    }

    public function newPropertyManagementView(Request $request){
            $id = base64_decode($request->id);
             $where = ['id'=>$id];
             $property_find = $this->PropertyModel()->getSingleProperty($where);
             $profile =PropertyImages::where(['property_id'=>$id])->get();
    		return view('admin.pages.property-management.new-property-management-view',compact('property_find','profile'));
    	}
       



    public function AcceptPropertyRequest(Request $request,$id){
            $admin_id = Admin::first();
            $property_data = Property::where('id',$id)->first();
                $user_data = User::where('id',$property_data->user_id)->first();
                if($property_data->status == 1){
                 $property_data->status = 2;
                 $property_data->update();
                 /*$message = "Accepted your property request";
                 $notificationMessage = "Accepted your property request";
                 $insertNotification = Notification::insert(['other_user_id' => $property_data->user_id, 'user_id' => $admin->id, 'message' => $message, 'notify_message' => $notificationMessage,'property_id' => $property_data->id,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]);
            $notifyMessage = array(
                'sound' => 1,
                'message' => $message,
                'id' => $property_data->id
            );
            $message_new = array('sound' =>1,'message'=>$message,
                                'notifykey'=>'accepted','id'=>$property_data->id);
            */
            
           /* if (!empty($user_data->device_type) && !empty($user_data->device_token))
            {
                if ($user_data->device_type == 'Android')
                {
                    $this->send_android_notification($user_data->device_token,"Accepted your property request",'accepted your property',$message_new);
                }
                else
                {
                    $this->send_iphone_notification($user_data->device_token, $message, $notmessage ="accepted your property", $notifyMessage);
                }
              }*/
                    Session::flash('message','Property request has been Accepted successfully.');
                    return redirect('admin/new-property-management');
       }
     }


    public function RejectPropertyRequest(Request $request,$id){
        $admin_id = Admin::first();
        $property_data = Property::where('id',$id)->first();
                $user_data = User::where('id',$property_data->user_id)->first();
                if($property_data->status == 1){
                 $property_data->status = 3;
                 $property_data->update();
                 /*$message = "Rejected your property request";
                 $notificationMessage = "Rejected your property request";
                 $insertNotification = Notification::insert(['other_user_id' => $property_data->user_id, 'user_id' => $admin->id, 'message' => $message, 'notify_message' => $notificationMessage,'property_id' => $property_data->id,'created_at' => date('Y-m-d H:i:s'),'updated_at' => date('Y-m-d H:i:s')]);
             $notifyMessage = array(
                'sound' => 1,
                'message' => $message,
                'id' => $property_data->id
            );
            $message_new = array('sound' =>1,'message'=>$message,
                                'notifykey'=>'accepted','id'=>$property_data->id);*/
            
            
          /*  if (!empty($user_data->device_type) && !empty($user_data->device_token))
            {
                if ($user_data->device_type == 'Android')
                {
                    $this->send_android_notification($user_data->device_token,"Rejected your property request",'rejected your property',$message_new);
                }
                else
                {
                    $this->send_iphone_notification($user_data->device_token, $message, $notmessage ="rejected your property", $notifyMessage);
                }
              }*/
               Session::flash('message','Property request has been rejected successfully.');
                return redirect(url('admin/new-property-management'));
        }

   
    }
        

       private function uploadImage($destinationPath,$image){
        $imageName = date('mdY') . uniqid().'.'.$image->getClientOriginalExtension();
        $image->move($destinationPath, $imageName);
        return $imageName;
     }


    private function parseFiles($request,$inputFiles){
      $images = $request->file($inputFiles);
  
        /* remove not acceptable images*/
        if($images && !empty($images)){
          $not_accept = array();
          $non_acceptable = $request->get("non_acceptable_files");

          if($non_acceptable && !empty($non_acceptable)){
            $exp = explode(",",$non_acceptable);
            $exp = array_filter($exp);
            $not_accept = array_values($exp);
          }
          
          for($w = 0;$w < count($not_accept);$w++){
            $val = $not_accept[$w];
            if(isset($images[$val[0]][$val[2]])){
              unset($images[$val[0]][$val[2]]);
            }
          }
        
          $images = array_filter($images);
          $images = array_values($images);
          $images = array_map(function($x){ return array_values($x); }, $images);
        }
        return $images;
    }

     public static function multipleImageUpload($request_profile, String $dir = "/app/public/property_images", $multiple = false) {
        $return_data = "";
        $profile = null;
        if ($multiple) {
            $profile = $request_profile;
        } else if ($request_profile->hasFile("media")) {
            $profile = $request_profile->file("media");
        }

        if ($profile) {
            $path = storage_path() . $dir;
            $file_name = $profile->getClientOriginalName();
            $file_name = uniqid() . "_" . $file_name;
            $file_name = str_replace(array(
                " ",
                "(",
                ")"
            ) , "", $file_name);
            if (!file_exists($path)) {
                mkdir(url($dir));
            }

            $profile->move($path, $file_name);
            $return_data = $file_name;
        }
        return $return_data;
    }




    
}
