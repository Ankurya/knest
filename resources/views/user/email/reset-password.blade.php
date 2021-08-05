<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{url('public/admin/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{url('public/admin/assets/img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Reset Password</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="{{url('public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet"> 
    <!-- data table css   -->
    <link href="{{url('public/admin/assets/css/dataTables.bootstrap.css')}}">
    
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <!-- Animation library for notifications   -->
    <link href="{{url('public/admin/assets/css/animate.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{url('public/admin/assets/css/bootstrap-select.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('public/admin/assets/css/bootstrap-clockpicker.min.css')}}">

    <!--  Paper Dashboard core CSS    -->
    <link href="{{url('public/admin/assets/css/paper-dashboard.css')}}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{url('public/admin/assets/css/demo.css')}}" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{url('public/admin/assets/css/themify-icons.css')}}" rel="stylesheet">

</head>

<style>
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
.text-danger:hover {
/* color: #a94442; */
color: red !important;
}

    </style>
<body>
<body>
    <!-- login section -->
    <section class="login_sec">
        <div class="container">
            <div class="row">
               
                <div class="col-sm-12">
            <div class="form">
               
                     <form method  = "POST" id = 'validate_form'>
                    {{ csrf_field() }}

                    <figure>
                          <a href="#"><img src="{{url('public/admin/assets/img/kush.png')}}"></a>
                        </figure>
                        @include('admin.layout.notification')
                        <h3>Reset Password</h3>  
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="New Password" name="password" id="password" />
                        <span class="text-danger">{{$errors->first('password')}}</span>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" name="confirm_password" />
                    <span class="text-danger">{{$errors->first('confirm_password')}}</span>
                    </div>
                    <div class="form-group submit">
                            <button type="submit"  class="button">Submit</button>
                           
                    </div>
                </form>
            </div>
            </div>
            </div>
        </div>
    </section>
    <!--   Core JS Files   -->
   <script src="{{url('public/admin/assets/js/jquery-1.10.2.js')}}" type="text/javascript"></script>
    <script src="{{url('public/admin/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>


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

    <script>
     $(".alert-success").fadeTo(2000, 5000).slideUp(500, function(){
      $(".alert-success").slideUp(500);
    });
   </script>

   <script>
     $(".alert-danger").fadeTo(2000, 5000).slideUp(500, function(){
      $(".alert-danger").slideUp(500);
    });
   </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js" integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
      <script>
         $('.navbar-right .user-profile.dropdown-toggle').click(function(){
           $("body").removeClass("nav-sm").addClass('nav-md');
         });
      </script>

      <script type="text/javascript">
          jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.length > 0 ? (value.trim().length == 0 ? false : true) : true
          }, "Space not allowed");

         $("#validate_form").validate({
            rules : {
              password :  {
                required: true,
                minlength : 6,
                noSpace:true
              },
              confirm_password :  {
                required: true,
                minlength : 6,
                noSpace:true,
                equalTo : "#password"
              }
            },
            messages : {
              password: {
                required : "Please enter new password.",
                minlength : "New password should be atleast 6 characters long."
              },
              confirm_password: {
                required : "Please enter confirm password.",
                minlength : "Confirm password should be atleast 6 characters long.",
                equalTo: "New password and confirm password must be same."
              }
            }
          })

          setTimeout(function(){
              $(".alert").hide();    
          },4000);

    
      </script>
    

</html>
        
