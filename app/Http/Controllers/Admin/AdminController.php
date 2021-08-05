<?php

namespace App\Http\Controllers\Admin;

header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use App\Mail\ForgotMail;


use App\Models\User;
use App\Models\Admin;
use App\Models\Password_reset;
use App\Models\Category;
use App\Models\Question;
use App\Models\Notification;

use Auth;
use Session;
use DB;
use Hash;
use Mail;
use Validator;
use Carbon\Carbon;


class AdminController extends Controller
{

	public function login(Request $request){
		if($request->isMethod("GET")){
			if(Auth::guard("admin")->check()){
				return redirect(url('admin/index'));
			}
			return view("admin/login");
		}
		if($request->isMethod("POST")){

			$email = $request->get("email");
			$password = $request->get("password");

			if(Auth::guard("admin")->attempt(array("email" => $email , "password" => $password))){
				return redirect(url("admin/index"))->with("success" , "Login successfully");
			}else{
				return back()->with("error" , "Email address or password is incorrect.");
			}
		}
	}


    public function logout(Request $request) {
        $request->session()->flush();
        $request->session()->regenerate();
        Session::flash('success', 'Logged out');
        return redirect(url("admin/login"));
    }


    public function changePassword(Request $request){
        $id = Auth::guard("admin")->id();
        if($request->isMethod("GET")){
            return view("admin/change_pass");
        }
        if($request->isMethod("POST"))
        {
            $admin =  Auth::guard("admin")->user();
            $old_password = $request->old_password; 
            $password = $admin->password;
                if(!Hash::check($old_password, $password)){
                    return redirect()->back()->with("error","Current password is not correct, Please try again.");
                }else {
                    $data = ["password" => Hash::make($request->new_password)];
                    $is_updated = Admin::where("id",$id)->update($data);
                    if($is_updated){
                        $request->session()->flush();
                        $request->session()->regenerate();
                        return redirect(url('admin/login'))->with("success","Password has been changed successfully.");
                    }else {
                        return redirect(url('admin/change-password'))->with("error","Unable to change password");
                    }
                }
        }
    }


    public function forgotPassword(Request $request){
        if($request->isMethod("GET")){
            if(Auth::guard("admin")->check()){
                return redirect(url('admin/index'));
            }
            return view("admin/forgot");
        }
        if($request->isMethod("POST")){ 
                $exist = Admin::where('email', $request->email)->first();
                $token = Str::random(32);
                $link = url('admin/reset-password',$token);

                if ($exist) {
                    DB::table('password_resets')->insert([
	                            'email' => $request->email,
	                            'token' => $token,
	                            ]);
                        $email = $request->email;

                    Mail::to($email)->send(new ForgotMail($exist,$link));
                    return back()->with("success","A reset password link has been sent to your registered email address.");
                }else{
                    return back()->with("error","Email is Invalid ");
                }

        }
    }


    public function resetpassword(Request $request){
        if ($request->isMethod("GET")){
            $token = $request->token;
            $tokenData = DB::table('password_resets')
                        ->whereToken($token)->first();

            if(!$tokenData) {
                return redirect("admin/link-expired");
            }
            if(Carbon::now() > Carbon::parse($tokenData->created_at)->addMinutes(10)){
                return redirect("admin/link-expired")->with("error","Invalid token");
            }      
            return view("email/reset-password");
        }
        if($request->isMethod("POST")){

            $token = $request->token;
            $getDetails = DB::table('password_resets')->whereToken($token)->first();
             
            if($getDetails) {
                $email = $getDetails->email;

                $password = Hash::make($request->new_password);
                $data = array('password'=>$password);

                $is_updated  = Admin::where("email",$email)->update($data);

                if($is_updated)
                {
                    DB::table('password_resets')->where("email",$email)->delete();
                    return redirect(url("admin/feedbackReset"))->with("success","your password changed successfully");
                }else {
                    return back()->with("error","Unable to reset your password");
                }
		         
            } else {
                return back()->with("error","Unable to reset your password");
            }

        }
    }


    public function feedbackReset(Request $request){
    	$title = "Password Reset Success";
    	$message = " Your password has been reset successfully.";
    	$type = "success";
            return view("email/feedback" , compact("title" , "message" , "type"));
    }


    public function linkExpired(Request $request){
        $title = "Link Expired";
        $message = "This Link has been Expired";
        $type = "error";
            return view("email/feedback" , compact("title" , "message" , "type"));
    }



    public function viewAllUser(Request $request){
        $data = User::orderBy("id","desc")->get();
        return view("admin/user-management" , ["data"=> $data]);
    }


    public function viewUser(Request $request , $id){
        $id = base64_decode($id);
        $data = User::where("id",$id)->first();
        return view("admin/user-details" , ["data"=>$data]);
    }

    public function addCategory(Request $request){
        if($request->isMethod("GET")){
           return view("admin/add_category");
        }

        if($request->isMethod("POST")){
            $data = [ 
                "name" => $request->name,
                "status" => $request->status,
                "price" => $request->price,
                "description" => $request->description,
            ];

            if($request->hasFile('image')) {
               $file = $request->file('image');
               $filename = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
               $file->move(storage_path()."/".env('CATEGORY_PATH'), $filename);
               $data["image"] = $filename;
            }

            $is_inserted = Category::create($data);

            if($is_inserted){
                return redirect(url("admin/category"))->with("success","Category added successfully");
            }else{
                return back()->with("error" ,"Unable to add category");
            }
        }
    }


    public function category(Request $request){
        $data = Category::orderBy("id","desc")->get();
        return view("admin/category" , ["data"=>$data]);
    }


    public function categoryDetail(Request $request , $id){
        $data = Category::where("id",$id)->first();
        return view("admin/category_detail" , ["data" => $data]);
    }

    public function deleteCategory(Request $request , $id){
        $is_deleted = Category::where("id",$id)->delete();
            if($is_deleted){
                return redirect(url('admin/category'))->with("success","Category deleted successfully");
            }else {
                return redirect(url('admin/category'))->with("error","Unable to delete category");
            }
    }


    public function editCategory(Request $request , $id){
    	if($request->isMethod("GET")){
          $data = Category::where("id",$id)->first();
           return view("admin/edit_category" , ["data"=>$data]);
        }

        if($request->isMethod("POST")){
            $data = [ 
                "name" => $request->name,
                "status" => $request->status,
                "price" => $request->price,
                "description" => $request->description,
            ];

            if($request->hasFile('image')) {
               $file = $request->file('image');
               $filename = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
               $file->move(storage_path()."/".env('CATEGORY_PATH'), $filename);
               $data["image"] = $filename;
            }

            $is_inserted = Category::where("id",$id)->update($data);

            if($is_inserted){
                return redirect(url("admin/category"))->with("success","Category edited successfully");
            }else{
                return back()->with("error" ,"Unable to edit category");
            }
        }
    }




    public function index(Request $request){
        $count_user = DB::table('users')->count();
        $count_category = DB::table('categories')->count();
        $count_question = DB::table('questions')->count();
        return view("admin/index", compact("count_user","count_category" ,"count_question"));
    }


    public function addQuestion(Request $request){
    	if($request->isMethod("GET")){
            $category = Category::orderBy("id","Desc")->get();
            return view("admin/add_question" , ["category" =>$category]);
        }

        if($request->isMethod("POST")){
             $data = [ 
                "category_id" => $request->category_name,
                "question" => $request->question,
            ];
            $is_inserted = Question::create($data);

            if($is_inserted){
                return redirect(url("admin/question-management"))->with("success","Question added successfully");
            }else{
                return back()->with("error" ,"Unable to add Question");
            }
        }
    }


    public function questionManagement(Request $request){
        $data = Question::orderBy("id","desc")->get();
        foreach( $data as $value){
           $category = Category::where("id",$value->category_id)->first();
           $value->category_name = $category->name;
        }
        return view("admin/question_management" , ["data"=>$data]);
    }


    public function questionDetail(Request $request , $id ){
         $data = Question::where("id" , $id)->first();
         $category = Category::where("id",$data->category_id)->first();
        return view("admin/question_details" ,compact("data",'category'));
    }



    public function deleteQuestion(Request $request , $id){
        $is_deleted = Question::where("id",$id)->delete();
            if($is_deleted){
                return redirect(url('admin/question-management'))->with("success","Question deleted successfully");
            }else {
                return redirect(url('admin/question-management'))->with("error","Unable to delete Question");
            }
    }



    public function editQuestion(Request $request , $id){
        if($request->isMethod("GET")){
            $category = Category::orderBy("id","Desc")->get();

             $question = Question::where("id",$id)->first();
             $category_list = Category::where("id",$question->category_id)->first();
             $category_name = $category_list->name;
            
            return view("admin/edit_question" , compact("category","question","category_name"));
        }

        if($request->isMethod("POST")){
            $data = [ 
                "category_id" => $request->category_name,
                "question" => $request->question,
            ];
            $is_updated = Question::where("id", $id)->update($data);

            if($is_updated){
                return redirect(url("admin/question-management"))->with("success","Question edit successfully");
            }else{
                return back()->with("error" ,"Unable to edit Question");
            }
        }
    }



    public function viewQuestion(Request $request , $id){
        $question = Question::where("category_id",$id)->get();
        return view("admin/view_question" , compact("question"));
    }


    public function pushNotification(Request $request){
        if($request->isMethod("GET")){
           return view("admin/push-notification");
        }

        if($request->isMethod("POST")){
            $data = [ 
                "message" => $request->message,
            ];
            $is_inserted = Notification::create($data);

            if($is_inserted){
                return redirect(url("admin/push-notification"))->with("success","Notification send successfully");
            }else{
                return back()->with("error" ,"Unable to send Notification");
            }
        }
    }


}
