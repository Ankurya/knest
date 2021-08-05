<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);


use App\Models\User;
use App\Models\Subscription;


class SubscriptionController extends Controller
{


    public function subscriptionManagement(Request $request){
        $data = Subscription::orderBy("id","desc")->with("user")->get(); 
    	return view('admin.pages.subscription-management.subscription-management' ,  ["data"=>$data]);
    }




    public function addSubscription(Request $request){
        if($request->isMethod('GET')){
        $user_detail = User::all();
    		return view('admin.pages.subscription-management.add-sub' , compact("user_detail"));
    	}

    	if($request->isMethod('POST')){
            // return $request->type;
            $data = [
                "user_id" => $request->user_name,
                "subscription_type" => $request->type,
                "subscription_start_date" => $request->start_date,
            ];

            $is_created = Subscription::create($data);

            if($is_created){
                return redirect(url("admin/subscription-management"))->with("success","Subscription added successfully.");
            }
            else{
                return back()->with("error" , "Unable to process your request.");
            }
    	}
    }




    public function editSubscription(Request $request , $id){
        if($request->isMethod("GET")){
             $user_detail = User::orderBy("id","Desc")->get();

             $subscription_detail = Subscription::where("id",$id)->first();
             $user_list = User::where("id",$subscription_detail->user_id)->first();
             $name = $user_list->name;
            
            return view("admin.pages.subscription-management.edit-sub" , compact("user_detail","subscription_detail","name"));
        }

        if($request->isMethod("POST")){
            $data = [
                "user_id" => $request->user_name,
                "subscription_type" => $request->type,
                "subscription_start_date" => $request->start_date,
            ];

            $is_updated = Subscription::where("id" , $id)->update($data);

            if($is_updated){
                return redirect(url("admin/subscription-management"))->with("success","Data updated successfully.");
            }
            else{
                return back()->with("error" , "Unable to process your request.");
            }
        }
    }



    public function viewSubscription(Request $request , $id){
        $data = Subscription::where("id",$id)->orderBy("id" , "Desc")->with("user")->first();
    	return view('admin.pages.subscription-management.view-sub' , compact("data"));
    }



    public function cancelSubscription(Request $request , $id){
        $data = Subscription::where("id",$id)->delete();
        return redirect(url("admin/subscription-management"))->with("success","Subscription cancelled successfully.");
    }



}
