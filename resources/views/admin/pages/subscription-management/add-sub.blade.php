

@extends('admin.layout.admin-layout')
@section('title','Add Subscription')
@section('content')
<style type="text/css">
    i.fa.fa-calendar {
    position: absolute;
    right: 7px;
    top: 12px;
}
/*form div {
      margin-bottom: 10px;
    }*/
    label.error {
      display: inline;
      color: red;
      font-weight: 400;
    }
</style>

<div class="content">

                <div class="contnt_heading">
                    <div class="container-fluid">
                        <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{route('admin.subscriptionManagement')}}"><span>Subscription Management</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Add</span></h5>
                    </div>
                </div>


          <form method="POST" action="" id="validate-form">
            {{csrf_field()}}

                      @if(Session::has("error"))
                      <div class="alert alert-danger" id="error_alert">{{Session::get("error")}}</div>
                      @endif
                      @if(Session::has("success"))
                      <div class="alert alert-success" id="success_alert">{{Session::get("success")}}</div>
                      @endif
                      @if ($errors->any())
                      <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                             {{ $error }}
                            @endforeach
                      </div>
                      @endif

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card_bg">
                                <h3 class="np-left">Add Subscription</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered card user-listing dataTable no-footer">
                                        <tbody>
                                             
                                            <tr>
                                             <td width="200">Name</td>

                                                 <td>
                                                <div class="field">
                                                  <select class="selectpicker" name="user_name">
                                                    <option  value="">Select</option>

                                                    @foreach($user_detail as $data)
                                                    <option value="{{$data->id}}">{{$data-> name}}</option>
                                                    @endforeach

                                                  </select>
                                            </div>
                                            </td>
                                          </tr>
                                           <tr>
                                            <tr>
                                             <td width="200">Subscription Type</td>

                                                 <td>
                                                <div class="field">
                                                <select class="selectpicker" name="type">
                                                <option value="">Select</option>
                                                <option value="monthly">Monthly</option>
                                                <option value="yearly">Yearly</option>
                                                </select>
                                            </div>
                                            </td>
                                          </tr>
                                           <tr>
                                                <td width="200">Subscription Start Date</td>
                                               <td><div class="field">
                                                        <span><div class="bootstrap-iso"> <input type="text" id="date" name="start_date" class="form-control datepicker" placeholder="Select Date"> <i class="fa fa-calendar" aria-hidden="true"></i></div></span>
                                                    </div>
                                                </td>
                                      </tr>

                                            <tr>
                                                <td>
                                                  
                                                </td>
                                                <td>
                                                  <!-- <a href="{{route('admin.subscriptionManagement')}}" class="btn btnlink">Add</a> -->
                                                   <button type = "submit" id="btnSubmit" name = "submit" class="btn btnlink"  style="margin-bottom: 16px;">Add</button>
                                                </td>
                                            </tr>
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
              </form>
            </div>

@endsection()
  @section('js')
    <script type="text/javascript" src="{{url('public/admin/assets/js/bootstrap-clockpicker.min.js')}}"></script>
    <script src="{{url('public/admin/assets/js/bootstrap-select.js')}}"></script>

  <script>
    $(document).ready(function(){
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
<script>
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>   
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js">
</script>

  <script>
      $(document).ready(function() {

        jQuery.validator.addMethod("noSpace", function(value, element) {
              return value.length > 0 ? (value.trim().length == 0 ? false : true) : true
            }, "Space not allowed.");


            $('#validate-form').validate({
                  rules: {
                      start_date: {
                        required: true,
                        noSpace:true,
                      },

                      type: {
                        required: true
                      },

                      user_name: {
                        required: true
                      },
                  },

                  messages: {
                    start_date: {
                      required : "Please enter start date.",
                    },
                    type: {
                      required : "Please select subscription type.",
                    },
                    user_name: {
                      required : "Please select name.",
                    },
                  },

                  submitHandler: function(form) { // <- pass 'form' argument in
                    $("#btnSubmit").attr("disabled", true);
                    form.submit(); // <- use 'form' argument here.
                  },
            });
      });
 </script>

@endsection()

