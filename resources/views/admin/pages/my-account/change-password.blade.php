
@extends('admin.layout.admin-layout')
@section('title','Update Password')
@section('content')
<style type="text/css">
    h3.np-left {
    display: inline-block;
}
.main-button{
        height: 39px;

}
.error {
color: red !important;
font-size: 16px;
}
.text-danger {
/* color: #a94442; */
color: red !important;
}
input.form-control.error{
    color: #000!important;
}
.error:hover{
color: red !important;
}


.alert-danger {
    background-color: #FF8F5E;
    color: #B33C12;
    text-align: center;
}
</style>
<div class="content">
            
             <div class="contnt_heading">
                 <div class="container-fluid">
                    <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="javascript:void(0);"><span>My Account</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Update Password</span></h5>
                 </div>
                </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card_bg">
                            <h3 class="np-left">Update Password</h3>
                            <div style="margin-top:20px;">
                           @if(session()->has("danger"))
                           <div class="alert alert-danger" role="alert">
                              {{session()->get("danger")}}
                           </div>
                           @endif 
                           @if(session()->has("success"))
                           <div class="alert alert-success" role="alert">
                              {{session()->get("success")}}
                           </div>
                           @endif
                        </div>
                            <div class="table-responsive">
                            <form method="post" id="validate_form">
                              {{csrf_field()}}
                            <table class="table table-striped table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Current Password</td>
                                            <td><div class="field"><input type="password" class="form-control" placeholder="Current Password" name="old_password" required =/>
                                            <label style="display: none;" id="old_password-error" class="error text-danger old_password_err" for="old_password">{{$errors->first('old_password')}}</label></div></td>
                                        </tr>
                                        <tr>
                                            <td>New Password</td>
                                            <td><div class="field"><input type="password" class="form-control" id="new_password" placeholder="New Password" name="new_password" required />
                                           <label style="display: none;" id="new_password-error" class="error text-danger new_password_err" for="new_password">{{$errors->first('new_password')}}</label></div></td>
                                        </tr>
                                        <tr>
                                            <td>Confirm Password</td>
                                            <td><div class="field"><input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" required />
                                            <label  style="display: none;" id="confirm_password-error" class="error text-danger confirm_password_err" for="confirm_password">{{$errors->first('confirm_password')}}</label></div></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><button class="main-button">Update</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>
        @endsection()

        @section('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
   $("#validate_form").validate({
        rules : {
           old_password  : {
             required : true,
           },
           new_password :  {
             required : true,
             minlength : 6
           },
           confirm_password : {
             required : true,
             minlength : 6,
             equalTo : "#new_password"
           }
       },
       messages : {
             old_password :  {
               required : "Please enter current password."
             },
             new_password :  {
               required : "Please enter new password.",
               minlength : "New password should be atleast 6 characters long."  
             },
             confirm_password : {
               required : "Please enter confirm password.",
               minlength : "Confirm password should be atleast 6 characters long." ,
               equalTo : "New password and Confirm password should be same."
             }  
       }
   
   });
   setTimeout(function(){
      $(".alert").hide();    
   },4000);
</script>


        @endsection
