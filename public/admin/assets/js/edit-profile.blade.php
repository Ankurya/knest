@extends("national_park/layout/national-park-layout")
@section("title","Edit Profile")
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.4/css/intlTelInput.css" integrity="sha256-rTKxJIIHupH7lFo30458ner8uoSSRYciA0gttCkw1JE=" crossorigin="anonymous" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/css/intlTelInput.css" rel="stylesheet" />
<style type="text/css">
  input.form-control{
     color: #000!important;
  }
  .intl-tel-input {
      position: relative;
      display: inline-block;
      width: 100%;
  }
  .form-control.change-color{
   background-position: 98.7% 51% !important;

  }

  p#msz {
    color: red !important;
  }

  select.member.change-color{
    color: grey !important;
  }
  select.member option { color: black; }

</style>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Edit Profile</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{url('national-park/dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                  <li class="breadcrumb-item active">Edit Profile</li>
               </ol>
            </div>
         </div>
      </div>
   </div>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="x_panel">
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
                        <div class="x_content new jack">
                           <form method="post" id="validate_form" enctype='multipart/form-data' onsubmit="return validate_form();">
                            {{csrf_field()}}
                              <div class="user_img add_img text-center mt-2">
                                 <a href="#" data-toggle="tooltip" data-placement="right" title="" >
                                  @if(!empty($user_details->profile)) 
                                    <img onclick="$('#imgInp').click()" style="cursor: pointer;" title="Change Image"  id="oldImg" src="{{$user_details->profile}}" alt="woman-3083387_1920">
                                  @else 
                                    <img onclick="$('#imgInp').click()" style="cursor: pointer;" title="Change Image" id="oldImg" src="{{url('public/national_park/dist/img/add_image.png')}}" alt="woman-3083387_1920">
                                  @endif
                                  <input style="display:none;" type="file" id="imgInp" name="profile" data-role="magic-overlay" data-target="#pictureBtn">
                               </a>
                               <p id="msz" style="margin-top: 3px; font-weight: 600" class="error text-danger"></p>
                              </div>
                              <div>
                                 <div class="form-group">
                                    <label>Authorized Person Name</label>
                                    <input type="text" class="form-control" maxlength="30" placeholder="Authorized Person Name" value="{{$user_details->firstname ?? ''}}" name="name" required/>
                                    <label id="name-error" class="error" for="name" style="display: none;">{{$errors->first('name')}}</label>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label>Authorized Person Designation</label>
                                 <input type="text" class="form-control" maxlength="50" placeholder="Authorized Person Designation" value="{{$user_details->person_designation ?? ''}}" name="person_designation" required />
                                 <label id="person_designation-error" class="error" for="person_designation" style="display: none;">{{$errors->first('person_designation')}}</label>
                              </div>
                              <div class="form-group">
                                 <label>Authorized Person Email Address</label>
                                 <input type="email" class="form-control" placeholder="Authorized Person Email Address" value="{{$user_details->email ?? ''}}" maxlength="100" name="email"  required />
                                 <label id="email-error" class="error" for="email" style="display: none;">{{$errors->first('email')}}</label>
                              </div>
                              <div class="form-group country_code">
                                 <label>Authorized Person Phone Number</label>
                                 <input  type="text" maxlength="15" class="form-control" placeholder="Authorized Person Phone Number" value="{{$user_details->country_code ?? ''}}{{$user_details->phone_number ?? ''}}"  name="phone_number" id="phone_number" required />
                                  <label id="phone_number-error" class="error" for="phone_number" style="display: none;">{{$errors->first('phone_number')}}</label>
                                  <input type="hiden" name="country_code" id="country_code" value="{{$user_details->country_code ?? ''}}">
                              </div>
                              <div class="form-group">
                                 <label>Owner/ Director/ CEO Person Name</label>
                                 <input type="text" class="form-control" maxlength="30" placeholder="Owner/ Director/ CEO Person Name" value="{{$user_details->ceo_person_name ?? ''}}" name="ceo_person_name" required />
                                 <label id="ceo_person_name-error" class="error" for="ceo_person_name" style="display: none;">{{$errors->first('ceo_person_name')}}</label>
                              </div>
                              <div class="form-group">
                                 <label>Owner/ Director/ CEO Person Designation</label>
                                 <input type="text" class="form-control" maxlength="50" placeholder="Owner/ Director/ CEO Person Designation" name="ceo_person_designation" value="{{$user_details->ceo_person_designation ?? ''}}" required />
                                  <label id="ceo_person_designation-error" class="error" for="ceo_person_designation" style="display: none;">{{$errors->first('ceo_person_designation')}}</label>
                              </div>
                              <div class="form-group">
                                 <label>Owner/ Director/ CEO Person Email Address</label>
                                  <input type="email" class="form-control" maxlength="100" placeholder="Owner/ Director/ CEO Person Email Address" name ="ceo_person_email" value="{{$user_details->ceo_person_email ?? ''}}" required />
                                  <label id="ceo_person_email-error" class="error" for="ceo_person_email" style="display: none;">{{$errors->first('ceo_person_email')}}</label>
                              </div>
                              <div class="form-group country_code">
                                 <label>Owner/ Director/ CEO Person Phone Number</label>
                                 <input  maxlength="15" id="ceo_person_phone" type="text" class="form-control" placeholder="Owner/ Director/ CEO Person Phone Number" name="ceo_person_phone" value="{{$user_details->ceo_country_code ?? ''}}{{$user_details->ceo_person_phone ?? ''}}" required />
                                 <input type="hiden" name="ceo_country_code" id="ceo_country_code" value="{{$user_details->ceo_country_code ?? ''}}">
                                 <label id="ceo_person_phone-error" class="error" for="ceo_person_phone" style="display: none;">{{$errors->first('ceo_person_phone')}}</label>
                              </div>
                              <div class="form-group">
                                 <label>Location</label>
                                 <input type="text" class="form-control" name="location" placeholder="Location" value="{{$user_details->location ?? ''}}" maxlength="100" required />
                              </div>
                              <div class="form-group">
                                <label>Region</label>
                                  <select class="form-control multipleer signup_select member change-color" name="region" required>
                                      <option value="">Select Region</option>
                                      <option @if($user_details->region == 'Nairobi') selected @endif value="Nairobi">Nairobi</option>
                                      <option @if($user_details->region == 'Kisumu') selected @endif value="Kisumu">Kisumu</option>
                                      <option @if($user_details->region == 'Mombasa') selected @endif value="Mombasa">Mombasa</option>
                                   </select>
                                   <label id="region-error" class="error" for="region" style="display: none;">{{$errors->first('region')}}</label>
                              </div>
                              <div class="form-group">
                                 <label>Registration Document</label>
                                 <div class="pdf_img">
                                    <img onclick="$('#pdf_upload').click()" class="pdf_upload" title="Click to upload PDF" style="cursor: pointer;" src="{{url('public/national_park/dist/img/pdf.png')}}" alt="pdf">
                                    <input style="display:none;" type="file" accept="doc,pdf,rtf,docx" id="pdf_upload" value="{{$user_details->registration_document}}" name="registration_document" data-role="magic-overlay" data-target="#pictureBtn">
                                 </div>
                                    @if($user_details->registration_document)
                                    <?php
                                      $url = url('public/storage/restaurant_images').'/'.$user_details->registration_document;
                                    ?>
                                    <a href="{{$url}}" target="_blank" class="pdf_view">{{$user_details->registration_document}}</a>
                                    @endif
                                  <label id="pdf_upload-error" class="error pdf_upload-error" for="pdf_upload">{{$errors->first('registration_document')}}</label>
                              </div>
                              <div class="form-group sign_textarea" style="margin-top: 0px;">
                                 <label>Address</label>
                                    <textarea name="address" rows="2" class="form-control" placeholder="Address" required>{{$user_details->address}}</textarea>
                                    <label id="address-error" class="error" for="address" style="display: none;">{{$errors->first('address')}}</label>
                              </div>
                              <div class="form-group">
                                 <label>Pin Number</label>
                                  <input type="text" class="form-control" placeholder="Pin Number" name="pin_number" maxlength="20" value="{{$user_details->pin_number ?? ''}}" required />
                                  <label id="pin_number-error" class="error" for="pin_number" style="display: none;">{{$errors->first('pin_number')}}</label>
                              </div>
                              <!-- <div class="form-group">
                                 <label>Email Address</label>
                                  <input type="email" class="form-control" placeholder="Email Address" name="park_email" value="{{$user_details->park_email ?? ''}}" required />
                                  <label id="park_email-error" class="error" for="park_email" style="display: none;">{{$errors->first('park_email')}}</label>
                              </div>
                              <div class="form-group country_code">
                                 <label>Phone Number</label>
                                 <input  maxlength="15" id="park_phone" name="park_phone" type="text" value="{{$user_details->park_country_code ?? ''}}{{$user_details->park_phone ?? ''}}" class="form-control" placeholder="Phone Number"  required />
                                 <label id="park_phone-error" class="error" for="park_phone" style="display: none;">{{$errors->first('park_phone')}}</label>
                                 <input type="hiden" name="park_country_code" id="park_country_code" value="{{$user_details->park_country_code ?? ''}}">
                              </div> -->
                              <div class="form-group" style="margin-bottom: 25px !important">
                                 <label>Do You Provide Activities?</label>
                                 <div class="sign_checkbox">
                                      <input type="checkbox" name="is_activities" @if($user_details->is_activities == "Yes") checked @endif value="Yes" class="activities">
                                      <label for="">Yes</label>
                                      <input type="checkbox" name="is_activities" @if($user_details->is_activities == "No") checked @endif name="is_activities" value="No" class="activities">
                                      <label for="">No</label>
                                   </div>
                                   <label id="is_activities-error" class="error" for="is_activities" style="display: none;"></label>
                              </div>
                              <div>  
                                <button class="btn btn-success submit new succces_btn">Update</button>
                              </div>
                              <div class="clearfix"></div>
                              <div class="new-heading">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/intlTelInput.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="{{url('public/national_park/dist/js/common.js')}}"></script>
<script>
   $(function () {
     $("#example1").DataTable({
       "responsive": true, "lengthChange": false, "autoWidth": false,
       "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
     $('#example2').DataTable({
       "paging": true,
       "lengthChange": false,
       "searching": false,
       "ordering": true,
       "info": true,
       "autoWidth": false,
       "responsive": true,
     });
   });
</script>
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
                  name : {
                     required : true,
                     minlength : 2,
                     noSpace: true
                  },
                  person_designation : {
                     required : true,
                     minlength : 2
                  },
                  ceo_person_name : {
                     required : true,
                     minlength : 2,
                     noSpace: true
                  },
                  ceo_person_designation : {
                     required : true,
                     minlength : 2,
                     noSpace: true
                  },

                  ceo_person_email : {
                     email : true,
                     required : true,
                     valid_email:true,
                     remote:"{{url('national-park/check-park-ceo')}}"
                  },

                  email : {
                     email : true,
                     required : true,
                     valid_email:true,
                     remote:"{{url('national-park/check-park-exist')}}"
                  },

                  // park_email : {
                  //    email : true,
                  //    required : true,
                  //    valid_email:true,
                  //    remote:"{{url('national-park/check-park-ceo')}}"
                  // },

                  ceo_person_phone : {
                     required : true,
                     number: true,
                     minlength : 8,
                     noSpace: true
                  },

                  phone_number : {
                     required : true,
                     number: true,
                     minlength : 8,
                     noSpace: true
                  },

                  // park_phone : {
                  //    required : true,
                  //    number: true,
                  //    minlength : 8,
                  //    noSpace: true
                  // },
                  
                  location : {
                     required : true,
                     minlength: 2
                  },

                  region : {
                     required : true
                  },

                  registration_document : {
                     // required : true
                  },

                  address : {
                     required : true,
                     minlength : 2,
                  },

                  pin_number : {
                     required : true,
                     number: true
                  },
                  no_of_safari : {
                     required : true,
                     number: true,
                     noSpace: true,
                     notOnlyZero: true
                  },
                  educational_background : {
                     required : true
                  },

                  is_activities : {
                     required : true
                  }
                  
             },
             messages : {
                 name : {
                     required : "Please enter authorized person name",
                     minlength : "Authorized person name should be atleast 2 characters long"
                 },
                 person_designation : {
                     required : "Please enter authorized person designation",
                     minlength : "Authorized person name should be atleast 2 characters long"
                 },

                 region : {
                     required : "Please select region"
                 },
                 email : {
                     required : "Please enter authorized person email address",
                     email : "Please enter a valid email address",
                     valid_email : "Please enter a valid email address"
                 },
                 phone_number : {
                     required : "Please enter authorized person phone number",
                     number: "Please enter a valid authorized person phone number",
                     minlength :"Phone number should be between 8 to 15 digits"
                 },
                  ceo_person_name : {
                     required : "Please enter Owner/ Director/ CEO person name",
                     minlength : "Authorized person name should be atleast 2 characters long"
                  },
                  ceo_person_designation : {
                     required : "Please enter Owner/ Director/ CEO person designation",
                     minlength : "Owner/ Director/ CEO person designation should be atleast 2 characters long"
                  },
                  ceo_person_email : {
                     required : "Please enter Owner/ Director/ CEO person email address",
                     valid_email: "Please enter a valid email address"
                  },
                  ceo_person_phone : {
                     required : "Please enter Owner/ Director/ CEO person phone number",
                     number: "Please enter a valid Owner/ Director/ CEO person phone number",
                     minlength :"Phone number should be between 8 to 15 digits"
                  },
                  location : {
                     required : "Please enter location",
                     minlength : "Location should be atleast 2 characters long"
                  },
                  registration_document : {
                     required : "Please upload registration document"
                  },

                  address : {
                     required : "Please enter address",
                     minlength : "Address should be atleast 2 characters long"
                  },
                  pin_number : {
                     required : "Please enter pin number",
                     number: "Please enter a valid number"
                  },
                  park_email : {
                     required : "Please enter email address",
                     valid_email: "Please enter a valid email address"

                  },
                  park_phone : {
                     required : "Please enter phone number",
                     number: "Please enter a valid phone number",
                     minlength :"Phone number should be between 8 to 15 digits"
                  },
                  is_activities : {
                     required : "Please select activities"
                  },

                   password :  {
                     required : "Please enter password",
                     minlength : "Password should be atleast 6 characters long"  
                   },
                   confirm_password : {
                     required : "Please enter confirm password",
                     minlength : "Confirm password should be atleast 6 characters long" ,
                     equalTo : "Password and Confirm password should be same"
                   } 
             }
         })

         setTimeout(function(){
             $(".alert").hide();    
         },4000);

         
         function validate_form() {
            if(form.valid()){
               $(".button_submit").attr("disabled",true);
               return true;
            }else {
               return false;
            }
         }
   </script>
@endsection