@extends('admin.layout.admin-layout')
@section('title','Manage Account')
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
                         <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="javascript:void(0);"><span>My Account</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Manage Account</span></h5>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                         @include('admin.layout.notification')
                        <div class="col-lg-12">
                            <div class="card_bg">
                                <h3 class="np-left">Manage Account</h3>
                                 <div>
                                 @if(session()->has("danger"))
                                 <div class="alert alert-danger" role="alert" >
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
                                   <form method="post" id="validate_form" enctype='multipart/form-data' >
                                     {{csrf_field()}}
                                    <table class="table table-striped table-bordered card user-listing dataTable no-footer">
                                        <tbody>
                                              <tr>
                                             <td width="200">Email Address</td>
                                                   <td> <div class="field"><div class="form-group">
                                                         <input type="email" class="form-control" placeholder="Enter Email Address" value="{{$admin_find->email ?? ''}}" maxlength="100" name="email"  required />
                                                         <label id="email-error" class="error" for="email" style="display: none;">{{$errors->first('email')}}</label></div></div></td>
                                          </tr>
                                          <tr>
                                          <td width="200">Phone Number</td>
                                                   <td> <div class="field"><div class="form-group">
                                                        <input  type="text" maxlength="15" class="form-control" placeholder="Enter Phone Number" value="{{$admin_find->phone_number ?? ''}}"  name="phone_number" id="phone_number" required />
                                                   <label id="phone_number-error" class="error" for="phone_number" style="display: none;">{{$errors->first('phone_number')}}</label></div></div></td>
                                          </tr>
                                         <tr>
                                                <td></td>
                                                <td><button class=" submit btn btnlink">Update</button></td>
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
         var form = $("#validate_form");
         $.validator.addMethod("notOnlyZero", function (value, element, param) {
             return this.optional(element) || parseInt(value) > 0;
         });

         jQuery.validator.addMethod("valid_email", function(value, element) {
               if(value.indexOf(".") >= 0 ){
                 return true;
               }else {
                 return false;
               }
         });

         $.validator.addMethod("greaterThan",function (value, element, param) {
                var $otherElement = $(param);
                return parseInt(value, 10) > parseInt($otherElement.val(), 10);
         });

         jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.length > 0 ? (value.trim().length == 0 ? false : true) : true
         }, "Space not allowed");

         form.validate({
            ignore: [],
            rules : {
               

                  email : {
                     email : true,
                     required : true,
                     valid_email:true,
                  },

                  phone_number : {
                     required : true,
                     number: true,
                     minlength : 8,
                     noSpace: true
                  },

               
                  
             },
             messages : {
               
                 email : {
                     required : "Please enter email address.",
                     email : "Please enter a valid email address.",
                     valid_email : "Please enter a valid email address."
                 },
                 phone_number : {
                     required : "Please enter phone number.",
                     number: "Please enter a valid  phone number.",
                     minlength :"Phone number should be between 8 to 15 digits."
                 }
             },
         })

         setTimeout(function(){
             $(".alert").hide();    
         },4000);

         
         function validate_form() {
            if(form.valid()){
               $(".submit").attr("disabled",true);
               return true;
            }else {
               return false;
            }
         }
   </script>
@endsection