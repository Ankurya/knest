@extends('admin.layout.admin-layout')
@section('title','Edit User Details')
@section('content')
 <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,400,400i,500i,600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.4/css/intlTelInput.css" integrity="sha256-rTKxJIIHupH7lFo30458ner8uoSSRYciA0gttCkw1JE=" crossorigin="anonymous" />
      <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/css/intlTelInput.css" rel="stylesheet" />

<style type="text/css">
  span#invalid_file{
    position: unset;
  }
  .uty-image{
        margin-bottom: 0;

  }
.intl-tel-input {
  width: 100%;
}
.error {
          width: 100%;
    font-weight: 300;
    font-size: 14px;
    margin-top: 0 !important;
    margin-bottom: 0;
    color: red;
}
.error:hover{
color: red !important;
}

  span#invalid_file{
    position: unset;
  }
  .uty-image{
        margin-bottom: 0;

  }

.iti{
      width: 100%;

}
.text-danger {
    /* color: #a94442; */
    color: red !important;
}

input.form-control.error{
    color: #000!important;
  }

  .user_img {
    text-align: center;
    margin-top: 13px !important;
  }

  label#imgInp-error {
    width: 100%;
  }
    .iti-flag.us {
    padding-right: 1px;
    padding-left: 2px;
    position: relative;
    left: 2px;
}
.field.date-time {
  display: block !important;
}

.intl-tel-input .selected-flag .iti-flag {
  left: 5px;
}
</style>

        <div class="content">
            
             <div class="contnt_heading">
                 <div class="container-fluid">
                    <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{route('admin.userManagement')}}">User Management</a><i class="fa fa-angle-right" aria-hidden="true"></i> <span>Edit User Details</span></h5>
                 </div>
                </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card_bg">
                                @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                                 @endforeach
                                  @endif
                            <h3 class="np-left">Edit User Details</h3>
                            <div class="table-responsive">
                           
                          <form method="post" id="validate_form" enctype="multipart/form-data">
                            
                                          {{csrf_field()}}
                           
                            <table class="table table-striped table-bordered">
                                    <tbody>
                                       
                                     <tr>
                                          <td width="200">Profile Image</td>
                                          <td>
                                         <div class="img-upload">
                                    <a href="#" data-placement="right" data-original-title="Upload Image" >
                                     @if(!empty($user_find->profile_image)) 
                                      <img onclick="$('#imgInp').click()" style="cursor: pointer; width: 100px; height: 100px;" title="Change Image"  id="oldImg" src="{{$user_find->profile_image}}" alt="image">
                                  @else 
                                    <img onclick="$('#imgInp').click()" style="cursor: pointer; width: 100px; height: 100px;" title="Change Image" id="oldImg" src="{{url('public/admin/assets/img/add_image.png')}}" alt="image">
                                  @endif
                                  <input style="display:none;" type="file" id="imgInp" name="profile_image" data-role="magic-overlay" data-target="#pictureBtn">
                               </a>
                               <p id="msz" style="margin-top: 3px; font-weight: 400" class="error text-danger"></p>
                                 <p id="imgInp-error" style="margin-top: 3px; font-weight: 400" class="error"></p>
                              </div>
                                        
                                </td>
                                     
                                        </tr>
                                          <tr>
                                          <td>Name</td>
                                          <td><div class="field date-time">
                                              <input type="text" class="form-control" maxlength="35" placeholder="Enter Name" value="{{$user_find->name ?? ''}}" name="name" required/>
                                            <label id="name-error" style=" width: 100%; font-weight: 300; display: none;" class="error" for="name" >{{$errors->first('name')}}</label> 
                                            </div>
                                           
                                        </td>
                                        </tr>
                                        <tr>
                                          <td>Email Address</td>
                                          <td><div class="field date-time"> <input type="email" class="form-control" placeholder="Enter Email Address" value="{{$user_find->email ?? ''}}"  name="email"  required />
                                            <label id="email-error" class="error"  style=" width: 100%; font-weight: 300; display: none;" for="email" >{{$errors->first('email')}}</label>
                                            </div>
                                            
                                          </td>
                                        </tr>
                                         
                                        <tr>
                                          <td>Phone Number</td>
                                          <td><div class="field date-time">
                                    
                                        <input  type="text" maxlength="15" class="form-control" placeholder="Enter Phone Number" value="{{$user_find->country_code ?? ''}}{{$user_find->phone_number ?? ''}}"  name="phone_number" id="phone_number" required />
                                        <input type="hiden" name="country_code" id="country_code" value="{{$user_find->country_code ?? ''}}">
                                        <label id="phone_number-error" style=" width: 100%; font-weight: 300; display: none;" class="error" for="phone_number" >{{$errors->first('phone_number')}}</label>
                                            </div>
                                           
                                          </td>
                                        </tr>
                                          <tr>
                                            <td>City</td>
                                            <td><div class="field date-time"><input type="text" class="form-control" maxlength="35" placeholder="Enter City Name" value="{{$user_find->city ?? ''}}" name="city" required/>
                                               <label id="city-error" class="error" style=" width: 100%; font-weight: 300; display: none;" for="city" >{{$errors->first('city')}}</label>
                                            </div>
                                          
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Pin Code</td>
                                               <td><div class="field date-time"> <input type="text" class="form-control" placeholder="Enter Pin Code" name="pin_code" maxlength="8" value="{{$user_find->pin_code ?? ''}}" required />
                                              <label id="pin_code-error" style=" width: 100%; font-weight: 300; display: none;" class="error" for="pin_code" >{{$errors->first('pin_code')}}</label>
                                               </div>
                                              
                                             </td>
                                           
                                        </tr>
                                  
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><button type="submit" class="btn btnlink main-button submit">Update</button>
                                          </td>
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
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/intlTelInput.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
  $('#country_code').hide();
   $("#phone_number").intlTelInput({
     initialCountry: "us",
     separateDialCode: true,
     nationalMode: false,
     formatOnDisplay: false,
     autoFormat: false,
     preferredCountries: ["fr", "us", "gb"],
     geoIpLookup: function (callback) {
         $.get('https://ipinfo.io', function () {
         }, "jsonp").always(function (resp) {
             var countryCode = (resp && resp.country) ? resp.country : "";
             callback(countryCode);
         });
     },
     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
     
   });
   
   $("#hiden").intlTelInput({
     initialCountry: "us",
     dropdownContainer: 'body',
     utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"
   });
   
      
   var country_code = $("#phone_number").intlTelInput();
   $("#phone_number").on("countrychange", function (e, countryData) {
     $("#phone_number").val('');
     var country_code = countryData['dialCode'];
     $('#country_code').val(country_code);
   });
   
   var number =  $('input[name="phone_number"]').val();
   var classf = $(".selected-flag > div").attr("class");
   var flag = classf.slice(-2);
   

   $('input.hide').parent().hide();

});
</script>

 <script type="text/javascript">
 function readURL(input) {
    if (input.files && input.files[0]) {  
        var type = input.files[0].type;
          var size = input.files[0].size;
           if(size > 10485760){
            $('#msz').show();
            $('#imgInp').val("");
            $('#oldImg').attr('src',"{{url('public/admin/assets/img/add_image.png')}}");
            $("#oldImg").removeClass("profile_image")
            $('#msz').text('Image size should not be greater than 10 MB.'); 

          }
        if(type == 'image/jpeg' || type == 'image/png'){
            var reader = new FileReader();
   
            reader.onload = function (e) {
                $('#oldImg').attr('src', e.target.result);
            }
   
            reader.readAsDataURL(input.files[0]);
            $('#msz').hide();
            $("#oldImg").addClass("profile_image")
            $('.test').hide();
   
        } else {
            $('#msz').show();
            $('#imgInp').val("");
            $("#oldImg").removeClass("profile_image")
            $('#msz').text('Only Jpeg and Png format allowed.');
        }
    }
}
$("#imgInp").change(function(){
  readURL(this);
});


</script>

<script type="text/javascript">
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

           $("#validate_form").validate({
            ignore: [],
            rules : {
                     name : {
                     required : true,
                     minlength : 2,
                     maxlength:35,
                     noSpace: true
                  },
                 

                     email : {
                     email : true,
                     required : true,
                     valid_email:true,
                     remote:"{{url('admin/check-exist-email',$user_find->id)}}"
                  },


                  phone_number : {
                     required : true,
                     number: true,
                     minlength : 8,
                     noSpace: true
                  },

                  city : {
                     required : true,
                     minlength: 2,
                     maxlength:35
                  },

              
                  pin_code : {
                     required : true,
                     number: true,
                     maxlength:8
                  }

                  
                  
             },
             messages : {
                 name : {
                     required : "Please enter name.",
                     minlength : "Name should be atleast 2 characters long.",
                      maxlength: 'Name cannot more than 35 characters.'
                 },
                 
                 email : {
                     required : "Please enter  email address.",
                     email : "Please enter valid email address.",
                     valid_email : "Please enter valid email address."
                 },
                 phone_number : {
                     required : "Please enter phone number.",
                     number: "Please enter a valid phone number.",
                     minlength :"Phone number should be between 8 to 15 digits."
                 },
                  
                  city : {
                     required : "Please enter city name.",
                     minlength : "City name should be atleast 2 characters long.",
                     maxlength: 'City name cannot more than 35 characters.'
                  },
                 
                  pin_code : {
                     required : "Please enter pin code.",
                     number: "Please enter valid pin code.",
                     maxlength: 'City cannot more than 8 numbers.'
                  }
                 
                 
             },
    
           submitHandler: function(form) { // <- pass 'form' argument in
                $(".submit").attr("disabled", true);
                form.submit();
            }
         })
         setTimeout(function(){
         $(".alert").hide();    
     },4000);
   </script>
@endsection

                                       