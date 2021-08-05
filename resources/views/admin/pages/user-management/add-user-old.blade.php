<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{url('public/admin/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{url('public/admin/assets/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Add User</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
     <link href="{{url('public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- data table css   -->
    <link href="{{url('public/admin/assets/css/dataTables.bootstrap.css')}}">

    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <!-- Animation library for notifications   -->
    <link href="{{url('public/admin/assets/css/animate.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{url('public/admin/assets/css/bootstrap-select.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('public/admin/assets/css/bootstrap-clockpicker.min.css')}}">


    <!--  Paper Dashboard core CSS    -->
    <link href="{{url('public/admin/assets/css/paper-dashboard.css')}}" rel="stylesheet" />

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{url('public/admin/assets/css/demo.css')}}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{url('public/admin/assets/css/themify-icons.css')}}" rel="stylesheet">

</head>
<body>

<div class="wrapper">
 <div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
    Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
    Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
  -->

      
  <div class="sidebar-wrapper">
                <div class="logo">
                    <figure>
                       <a href="{{route('admin.dashboard')}}" class="simple-text">
                            <img src="{{url('public/admin/assets/img/kush.png')}}">
                        </a>
                    </figure>
                     <div class="logo-text">
                    <h4>Admin</h4>
                </div>

                </div>

            <ul class="nav">
                    <li class="@if(Request::is('admin/dashboard')) active @else @endif()">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fa fa-dashcube" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="@if(Request::is('admin/user-management')  || Request::is('admin/edit-user') || Request::is('admin/view-user') || Request::is('admin/add-user')) active @else @endif()">
                        <a href="{{route('admin.userManagement')}}">
                          <i class="fa fa-user" aria-hidden="true"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                      <li class="dropdown @if(Request::is('admin/property')  || Request::is('admin/edit-property') || Request::is('admin/view-property') || Request::is('admin/add-property') || Request::is('admin/new-property-management') || Request::is('admin/new-property-management-view')) open active @else @endif()">
                    <a href="javascript:void(0)" class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-home"></i>
                        <p>Property Management</p>
                    <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="@if(Request::is('admin/new-property-management') || Request::is('admin/new-property-management-view')) active @else @endif()"><a href="{{route('admin.newPropertyManagement')}}"><i class="fa fa-plus"></i> <p>New Property Request</p></a></li>
                        <li class="@if(Request::is('admin/property')  || Request::is('admin/edit-property') || Request::is('admin/view-property') || Request::is('admin/add-property')) active @else @endif()"><a href="{{route('admin.property')}}"><i class="fa fa-list"></i> <p>Property</p></a></li>
                      </ul>
                </li>
                     <li class="@if(Request::is('admin/subscription-management') || Request::is('admin/add-subscription') || Request::is('admin/edit-subscription') || Request::is('admin/view-subscription')) active @else @endif()">
                        <a href="{{route('admin.subscriptionManagement')}}">
                  <i class="fa fa-external-link-square" aria-hidden="true"></i>

                        <p>Subscription Management</p>
                        </a>
                    </li>
                     
                      <li class="dropdown @if(Request::is('admin/manage-account')  || Request::is('admin/update-password')) open active @else @endif()">
                    <a href="javascript:void(0)" class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                        <p>My Account</p>
                    <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="@if(Request::is('admin/manage-account')) active @else @endif()"><a href="{{route('admin.manageAccount')}}"><i class="fa fa-envelope" aria-hidden="true"></i><p>Manage Account
</p></a></li>
                        <li class="@if(Request::is('admin/update-password')) active @else @endif()"><a href="{{route('admin.updatePassword')}}"><i class="fa fa-key" aria-hidden="true"></i><p>Update Password</p></a></li>
                      </ul>
                </li>

                    <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>

                            <p>Logout</p>
                        </a></li>
                </ul>
            </div>
    </div> 
    <div class="main-panel">
    <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">                       
                        
                    </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            
             <div class="contnt_heading">
                 <div class="container-fluid">
                    <h5><a href="dashboard.html"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="user-management.html">User Management</a><i class="fa fa-angle-right" aria-hidden="true"></i> <span>Add</span></h5>
                 </div>
                </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card_bg">
                            <h3 class="np-left">Add User</h3>
                                <div class="table-responsive">
                               <div>
                                <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif -->
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
                            <table class="table table-striped table-bordered">
                                    <tbody>
                                       <form method="post" id="validate_form" enctype='multipart/form-data'>
                                          {{csrf_field()}}
                                                                                    <tr>
                                          <td width="200">Profile Image</td>
                                          <td>
                               <div class="img-upload">
                                 <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="Upload Image">
                                    <img onclick="$('#imgInp').click()" style="cursor: pointer;width: 100px; height: 100px;" title="upload image"  id="oldImg" src="{{url('public/admin/assets/img/user.png')}}" alt="woman-3083387_1920">
                                    <input style="display:none;" type="file" id="imgInp" name="profile_image" data-role="magic-overlay" data-target="#pictureBtn">
                                 </a>
                                 <!--  <div style="display:none; color: #ff0000 !important;width: 100%;text-align: center;     margin-top: 5px;" class="text-danger" id="invalid_file">Please select jpg, jpeg or png image format only. </div> -->
                                 <label id="imgInp-error" class="error msz" for="imgInp"></label>
                              </div>
                                        
                                </td>
                                     
                                        </tr>
                                          <tr>
                                          <td>Name</td>
                                          <td><div class="field">
                                              <input type="text" class="form-control" maxlength="30" placeholder="Enter Name" value="{{old('name')}}" name="name" required/>
                                              <label id="name-error" class="error" for="name" >{{$errors->first('name')}}</label>
                                            </div>
                                        </td>
                                        </tr>
                                        <tr>
                                          <td>Email Address</td>
                                          <td><div class="field"> <input type="email" class="form-control" placeholder="Enter Email Address" value="{{old('email')}}" maxlength="100" name="email"  required />
                                            <label id="email-error" class="error" for="email" >{{$errors->first('email')}}</label>
                                            </div></td>
                                        </tr>
                                         
                                        <tr>
                                          <td>Phone Number</td>
                                          <td><div class="field">
                                    
                                        <input  type="text" name="phone_number" maxlength="15" class="form-control" placeholder="Enter Phone Number" value="{{old('country_code')}}{{old('phone_number')}}"  id="phone_number" required />

                                      <label id="phone_number-error" class="error" for="phone_number" >{{$errors->first('phone_number')}}</label>

                                       <input type="hiden" name="country_code" id="country_code" value="{{old('country_code')}}">
                                            </div></td>
                                        </tr>
                                          <tr>
                                            <td>City</td>
                                            <td><div class="field"><input type="text" class="form-control" maxlength="30" placeholder="Enter City Name" value="{{old('city')}}" name="city" required/>
                                              <label id="name-error" class="error" for="city_name" >{{$errors->first('city')}}</label>
                                            </div></td>
                                        </tr>
                                        <tr>
                                          <td>Pin Code</td>
                                               <td><div class="field"> <input type="text" class="form-control" placeholder="Pin Code" name="pin_code" maxlength="20" value="{{old('pin_code')}}" required />
                                              <label id="pin_code-error" class="error" for="pin_code" >{{$errors->first('pin_code')}}</label>
                                               </div></td>
                                           
                                        </tr>
                                         <tr>
                                          <td>Password</td>
                                               <td><div class="field"> <input type="text" class="form-control" placeholder="Pin Code" name="Password" maxlength="20" value="{{old('Password')}}" required />
                                              <label id="pin_code-error" class="error" for="pin_code" >{{$errors->first('pin_code')}}</label>
                                               </div></td>
                                           
                                        </tr>
                                      
                                        <tr>
                                          <td>&nbsp;</td>
                                          <td><button type="submit" class="btn btnlink main-button">Add</button>
                                          </td>
                                        </tr>
                                  <!--   </form> -->
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>



    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
        if(type == 'image/jpeg' || type == 'image/png'){
            var reader = new FileReader();
   
            reader.onload = function (e) {
                $('#oldImg').attr('src', e.target.result);
            }
   
            reader.readAsDataURL(input.files[0]);
            $("#oldImg").addClass("profile_image")
            $('.test').hide();
            $('#imgInp-error').text('');
   
        } else {
            $('#imgInp').val("");
            $('#oldImg').attr('src',"{{url('public/admin/assets/img/user.png')}}");
            $("#oldImg").removeClass("profile_image")
            $('#imgInp-error').text('Only Jpeg and Png format allowed');
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
                     noSpace: true
                  },
                 

                     email : {
                     email : true,
                     required : true,
                     valid_email:true,
                     remote:"{{url('admin/check-exist-email')}}"
                  },


                  phone_number : {
                     required : true,
                     number: true,
                     minlength : 8,
                     noSpace: true
                  },

                  city : {
                     required : true,
                     minlength: 2
                  },

              
                  pin_code : {
                     required : true,
                     number: true
                  },
                    profile_image : {
                     required : true,
                    extension: "jpeg|png",
                  },
                  
             },
             messages : {
                 name : {
                     required : "Please enter  name",
                     minlength : "Name should be atleast 2 characters long"
                 },
                 
                 email : {
                     required : "Please enter  email address",
                     email : "Please enter a valid email address",
                     valid_email : "Please enter a valid email address"
                 },
                 phone_number : {
                     required : "Please enter phone number",
                     number: "Please enter a valid phone number",
                     minlength :"Phone number should be between 8 to 15 digits"
                 },
                  
                  city : {
                     required : "Please enter city",
                     minlength : "City should be atleast 2 characters long"
                  },
                 
                  pin_code : {
                     required : "Please enter pin code",
                     number: "Please enter a valid pin code"
                  },
                   profile : {
                     required : "Please upload image"
                  },
                 
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
<script src="{{url('public/admin/assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{url('public/admin/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js')}}"></script>


    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{url('public/admin/assets/js/bootstrap-checkbox-radio.js')}}"></script>

    <!--  Charts Plugin -->
    <script src="{{url('public/admin/assets/js/chartist.min.js')}}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{url('public/admin/assets/js/bootstrap-notify.js')}}"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="{{url('public/admin/assets/js/paper-dashboard.js')}}"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{url('public/admin/assets/js/demo.js')}}"></script>
    <script type="text/javascript" src="{{url('public/admin/assets/js/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{url('public/admin/assets/js/bootstrap-select.js')}}"></script>
    <script type="text/javascript">
        $(function() {
            $(".datepicker").datepicker();
        });

    </script>
    <script type="text/javascript">
        $('.clockpicker').clockpicker();

    </script>
    <script type="text/javascript">
function myFunction() {
  // Declare variables 
  var input, filter, table, tr, td, i;
  input = document.getElementById("example_filter");
  filter = input.value.toUpperCase();
  table = document.getElementById("example");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}



</script>
</body>
</html>
