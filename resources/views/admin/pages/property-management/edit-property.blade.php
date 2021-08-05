@extends('admin.layout.admin-layout')
@section('title','Edit Property Details')
<link rel="apple-touch-icon" sizes="76x76" href="{{url('public/admin/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{url('public/admin/assets/img/favicon.png')}}">
@section('content')
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style type="text/css">
   input.form-control{
   color: #000!important;
   }
   .restru_images .img_count {
   display: flex;
   flex-wrap: wrap;
   }
   .restru_images .img_count .close {
   position: relative;
   float: left;
   opacity: 1;
   }
   .restru_images .remove-img {
   width: 20px;
   height: 20px;
   padding: 4px;
   border-radius: 50%;
   position: absolute;
   right: -9px;
   top: -8px;
   background-image: url('{{url("public/admin/assets/img/cross_icon.png")}}');
   background-size: cover;
   cursor: pointer;
   z-index: 1;
   }
   .bootstrap-select .dropdown-toggle:focus{
       outline: 0px auto -webkit-focus-ring-color !important;

}

   .close .remove-img {
   right: 6px;
   }
   input.form-control{
   color: #000!important;
   }
   input.form-control{
   color: #000!important;
   }
   form div {
   margin-bottom: 0px;
   }
   .error {
   color: red !important;
   font-size:14px !important; 
   }
   label.error {
   display: inline;
   }
   .form-control {
   color: black !important;
   }
   /*date*/
   .no-footer span :nth-child(2), .btn.btn-danger{
   border:none !important;
   }
   .images_placehold {
   cursor: pointer;
   }
   .preview_image_cover .preview_video {
   max-height: 143px;
   max-width: 117px;
   height: 100px;
   width: 102px;
   background-color: #ffffff;
   border: 2px solid #000;
   border-radius: 3px;
   }
   .media_preview .upload_images {
   padding-left: 0;
   }
   .media_preview .upload_images .preview_image_cover {
   text-align: left;
   }
   .preview_image_cover.video {
   background-color: #fff;
   border: 2px solid #000;
   width: 89px;
   border-radius: 3px;
   }
   .choose_images {
   width: 100px;
   height: 100px;
   object-fit: scale-down;
   }
   .text-danger {
   color: red;
   display: block;
   }
   .preview_image_cover img {
   margin-left: 0;
   height: 100px;
   object-fit: contain;
   background-color: #fff;
   border: 2px solid #000;
   width: 100%;
   margin-bottom: 8px;
   border-radius: 3px;
   }
   .media_preview .upload_images {
   width: 160px;
   height: 136px;
   float: left;
   position: relative;
   word-break: break-all;
   border: 1px solid lightgray;
   margin: 0 15px 15px 0;
   padding: 2px;
   display: flex;
   align-items: center;
   justify-content: center;
   }
   /* .media_preview .preview_image {
   padding-bottom: 0px;
   margin:0 !important;
   width: 160px;
   height: 136px;
   object-fit: cover;
   }*/
   .upload_image {
   display: none !important;
   }
   .remove-img {
   width: 20px;
   height: 20px;
   padding: 4px;
   border-radius: 50%;
   box-shadow: 0px 0px 54px 0px rgba(82, 82, 82, 0.35);
   position: absolute;
   right: -7px;
   top: -10px;
   background-image: url('{{url("public/admin/assets/img/cross_icon.png")}}');
   background-size: cover;
   cursor: pointer;
   z-index: 1;
    background-color: #fff;
    box-shadow: 2px 5px 11px #b1b1b1;
    object-fit: contain;
   }
   .restru_images {
   display: block;
   }
   .restru_images .img_count{
   display: block;
   }
   .clear-fix {
   clear: both;
   width: 100%
   }
   #image_error {
   margin-top: -30px !important;
   color: red !important;
   margin-bottom: -1px;
   font-size: 14px;
   }
   .close img{
   width: 160px;
   height: 136px;
   float: left;
   position: relative;
   word-break: break-all;
   border: 1px solid lightgray;
   margin: 0 15px 15px 0;
   padding: 2px;
   display: flex;
   align-items: center;
   justify-content: center;
   }
   /*.restru_images img {
   padding-right: 0px !important;
   }
   .close img {
   padding-right: 15px !important;
   }*/
   .media_preview {
   width: 100%;
   }
   .first-taber table#datatable-filter tr td {
   padding: 16px 12px!important;
   vertical-align: sub;
   }
   .x_content.new table#datatable-filter label{
   width: 118%!important;
   word-break: break-all;
   display: inline-block;
   white-space: break-spaces;
   margin-top: 0;
   text-align: left;
   }
   .x_content.new table#datatable-filter  .form-control {
   max-width: 100%;
   width: 170px!important;
   }
   .ui-widget-header{
   background-color: #333!important;
   background: #333!important;
   border: 1px solid #333!important;
   }
   .restru_images img{
   width: 160px;
   height: 136px;
   float: left;
   position: relative;
   word-break: break-all;
   padding: 2px;
   display: flex;
   align-items: center;
   justify-content: center;
    object-fit: contain;
   }.sign_textarea{
   margin-top: 3px;
   }
   .file-inline.night_width {
   width: 100% !important;
   }
   .file-inline .af_mu {
   display: flex;
   width: 100%;
   }
   .file-inline  .date_content {
   display: flex;
   margin-left: 87px;
   flex-wrap: wrap;
   }
   .file-inline  .date_content input {
   margin-right: 15px;
   }
   input.form-control{
   color: #000!important;
   }
   .error {
   color: red !important;
   font-size:14px !important; 
   }
   label.error {
   display: inline;
   }
   .form-control {
   color: black !important;
   }
   /*date*/
   .no-footer span :nth-child(2), .btn.btn-danger{
   border:none !important;
   }
   .images_placehold {
   cursor: pointer;
   }
   .images_placehold {
   border: 0;
   height: 160px;
   width: 136px;
   }
   .text-danger {
   /* color: #a94442; */
   color: red;
   }
   input.form-control.error{
   color: #000!important;
   }
   .error {
   color: red;
   font-size: 16px;
   }
   #datepicker-3 {
   cursor: pointer;
   }
   .card_bg .field .clockpicker {
   position: relative;
   width: 100%;
    margin-bottom: 0;

   }
   label#image_error {
    display: block!important;
    margin-top: 0!important;
   }

   span.input-group-addon.first {
   display: unset!important;
   right: -2px!important;
   width: unset!important;
   position: absolute!important;
   top:4px!important;
   background-color: transparent !important;
   }
   .card_bg .field .cal{
   margin-right: 0;
   }
   .input-group-addon{
   margin-right: 0px;
   }
   label#start_time-error {
    color: red;
    font-size: 14px;
    margin-top: 0;
    margin-bottom: 0px;
    font-weight: 400;
}
label#end_time-error {
    color: red;
    font-size: 14px;
    margin-top: 0;
    margin-bottom: 0px;
    font-weight: 400;
}
.card_bg .field .cal span i {
   right: -8px;
}
.up_down_arrow {
   padding: 7px 9px 7px 18px
}
</style>
<div class="content">
   <div class="contnt_heading">
      <div class="container-fluid">
         <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="javascript:void(0);"><span>Property Management</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{route('admin.property')}}"><span>Property</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Edit Property Details</span></h5>
      </div>
   </div>
   <div class="container-fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="card_bg">
               <h3 class="np-left">Edit Property Details</h3>
               <div class="table-responsive">
                  <form method="post" id="validate_form" enctype="multipart/form-data" >
                     {{csrf_field()}}
                     <table class="table table-striped table-bordered card user-listing dataTable no-footer">
                        <tbody>
                           <tr>
                             
                              <td width="200">Property Image</td>
                               <input type="hidden" name="delete_images" id="delete_image">
                              <td>
                                 <div class="restru_images" style="margin-top: 11px;">
                                    <div class="images_container">
                                       <div class="img_count">
                                          <div class="media_preview">
                                             <?php $count = 0; ?>
                                             @foreach($profile as $photo)
                                             @php ($urls = $photo->profile ? url($photo->profile) : url('public/admin/assets/img/add_image.png'))
                                             <div class="close"  >
                                                <img src='{{$urls}}' id="{{$photo->id}}" /> 
                                                <i class="remove-img" id="{{$photo->id}}" data-parent="0_0" title="Remove image" type="total-media"></i>
                                             </div>
                                             <?php $count++ ?>
                                             @endforeach
                                          </div>
                                          <div class="media_inputs">
                                             <div class="img_upload upload_images">
                                                <input type="hidden" name="non_acceptable_files" class="non_acceptable_files">
                                                <input type="hidden" class="ext_media_record" images="0" total-media ="{{$count}}" />
                                                <img src="{{url('public/admin/assets/img/add_image.png')}}" class="images_placehold" title="Select image" data-recursion="-1" />
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="clr"></div>
                                    <label class="custom_error" id="image_error" style="display: none;"></label>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Property Type</td>
                              <td>
                                 <div class="field">
                                    <select name="property_type" class="selectpicker property_type" >
                                       <option value="" selected>Select Property Type </option>
                                       <!-- <select class="selectpicker"> -->
                                       <option value="For Sale" @if($property_find->property_type == "For Sale") selected="selected"@endif() >For Sale</option>
                                       <option value="For Rent" @if($property_find->property_type  == "For Rent") selected="selected"@endif()>For Rent</option> 
                                    </select>
                                    <label id="property_type-error" class="error" for="property_type" >{{$errors->first('property_type')}}</label>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Property Price</td>
                              <td>
                                 <div class="field">
                                    <div class="form-group">
                                       <input type="text" class="form-control" maxlength="8" name = "property_price" value ="{{$property_find->property_price}}" placeholder="Property Price"><span class="material-input"></span>
                                       <label id="property_price-error" class="error" for="property_price" >{{$errors->first('property_price')}}</label>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Number Of Bedroom</td>
                              <td>
                                 <div class="field">
                                    <select name="number_of_bedroom" class="selectpicker bedroom_type" >
                                       <option value="" selected>Select Number of Bedroom</option>
                                       <!-- <select class="selectpicker"> -->
                                       <option value="1" @if($property_find->number_of_bedroom == "1") selected="selected"@endif() >1</option>
                                       <option value="2" @if($property_find->number_of_bedroom == "2") selected="selected"@endif() >2</option>
                                       <option value="3" @if($property_find->number_of_bedroom == "3") selected="selected"@endif() >3</option>
                                       <option value="4" @if($property_find->number_of_bedroom == "4") selected="selected"@endif() >4</option>
                                       <option value="5" @if($property_find->number_of_bedroom == "5") selected="selected"@endif() >5</option>
                                       <option value="6" @if($property_find->number_of_bedroom == "6") selected="selected"@endif() >6</option>
                                      
                                    </select>
                                    <label id="number_of_bedroom-error" class="error" for="number_of_bedroom" >{{$errors->first('number_of_bedroom')}}</label>
                                 </div>
                                
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Number Of Bathroom</td>
                              <td>
                                <div class="field">
                                    <select name="number_of_bathroom" class="selectpicker bathroom_type" >
                                       <option value="" selected>Select Number of Bathroom </option>
                                       <!-- <select class="selectpicker"> -->
                                       <option value="1" @if($property_find->number_of_bathroom == "1") selected="selected"@endif() >1</option>
                                       <option value="2" @if($property_find->number_of_bathroom == "2") selected="selected"@endif() >2</option>
                                       <option value="3" @if($property_find->number_of_bathroom == "3") selected="selected"@endif() >3</option>
                                       <option value="4" @if($property_find->number_of_bathroom == "4") selected="selected"@endif() >4</option>
                                       <option value="5" @if($property_find->number_of_bathroom == "5") selected="selected"@endif() >5</option>
                                       <option value="6" @if($property_find->number_of_bathroom == "6") selected="selected"@endif() >6</option>
                                      
                                    </select>
                                    <label id="number_of_bathroom-error" class="error" for="number_of_bathroom" >{{$errors->first('number_of_bathroom')}}</label>
                                 </div>
                               
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Address</td>
                              <td>
                                 <div class="field">
                                    <div class="form-group">
                                       <input type="text" id="autocomplete" name = "address" maxlength="150" value = "{{$property_find->address}}"  class="form-control" placeholder="Address"><span class="material-input"></span>
                                       <label id="address-error" class="error" for="address" >{{$errors->first('address')}}</label>
                                       <input type="hidden" id="lat_val" name="lat" value="{{$property_find->latitude}}">
                                             <input type="hidden" id="long_val" name="long" value="{{$property_find->longitude}}">
                                    </div>
                                 </div>
                              </td>
                           </tr>
                                <tr>
                              <td width="200">Date</td>
                              <td>
                                 <div class="field date-time">
                                    <div class="cal w100">
                                       <span> <input type="text"  name = "date"  value = "{{$property_find->date}}" id="datepicker-3" placelhoder="Select Date" class="form-control datepicker" readonly='true'> <i class="fa fa-calendar" aria-hidden="true"></i></span>
                                       <label id="date-error" class="error" for="date" >{{$errors->first('date')}}</label>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Start Time</td>
                              <td>
                                 <div class="field">
                                    <div class="cal w100">
                                       <div class="clockpicker" data-placement="right" data-align="top" data-autoclose="true">
                                          <input type="text" name ="start_time" id="start_time" value = "{{$property_find->start_time}}" placelhoder="Select Start Time" class="form-control" readonly='true'>
                                          <span class="input-group-addon first">
                                          <span class="glyphicon glyphicon-time"></span>
                                          </span>
                                          <label id="start_time-error">{{$errors->first('start_time')}}</label>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">End Time</td>
                              <td>
                                 <div class="field">
                                    <div class="cal w100">
                                       <div class="clockpicker1" data-placement="right" data-align="top" data-autoclose="true">
                                          <input type="text" name ="end_time" id="end_time" value = "{{$property_find->end_time}}" placelhoder="Select End Time" class="form-control" readonly='true'>
                                          <span class="input-group-addon first">
                                          <span class="glyphicon glyphicon-time"></span>
                                          </span>
                                          <label id="end_time-error">{{$errors->first('end_time')}}</label>
                                       </div>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                        
                           <tr>
                              <td width="200">Tax</td>
                              <td>
                                 <div class="field">
                                    <div class="form-group">
                                       <input type="text" name = "tax" maxlength="10" value = "{{$property_find->tax}}"  class="form-control" placeholder="Tax(optional)"><span class="material-input"></span>
                                       <label id="tax-error" class="error" for="tax" >{{$errors->first('tax')}}</label>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Plot Size</td>
                              <td>
                                 <div class="field">
                                    <div class="form-group">
                                       <input type="text" name = "plot_size" maxlength="10" value = "{{$property_find->plot_size}}"  class="form-control" placeholder="Plot Size(sqft)(optional)"><span class="material-input"></span>
                                       <label id="plot_size-error" class="error" for="plot_size" >{{$errors->first('plot_size')}}</label>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">Building Size</td>
                              <td>
                                 <div class="field">
                                    <div class="form-group">
                                       <input type="text" name = "building_size" maxlength="10" value = "{{$property_find->building_size}}"  class="form-control" placeholder="Building Size(sqft)(optional)"><span class="material-input"></span>
                                       <label id="building_size-error" class="error" for="building_size" >{{$errors->first('building_size')}}</label>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td width="200">School/District</td>
                              <td>
                                 <div class="field">
                                    <div class="form-group">
                                       <input type="text" name = "school_district"  maxlength="50"value = "{{$property_find->school_district}}"  class="form-control" placeholder="School/ District(optional)"><span class="material-input"></span>
                                       <label id="school_district-error" class="error" for="school_district" >{{$errors->first('school_district')}}</label>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                               <tr>
                              <td width="200">Description</td>
                              <td>
                                 <div class="field">
                                    <div class="form-group"><textarea class="form-control" maxlength="400" name ="description" style="height: 150px;" placeholder="Description">{{$property_find->description}}</textarea><span class="material-input"></span>
                                       <label id="description-error" class="error" for="description" >{{$errors->first('description')}}</label>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td></td>
                              <td><button type="submit" id="submit_btn" class="btn btnlink submit">Update</button></td>
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
<script src="{{url('public/admin/assets/js/bootstrap-select.js')}}"></script>
<!-- multiple image upload -->
<script src="{{url('public/admin/assets/js/editMultipleImages.js')}}"></script>
<script type="text/javascript" src="{{url('public/admin/assets/js/bootstrap-clockpicker.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script> 
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbgWTyuXJbZtehcat3VvAsHE3FyapBVDs&libraries=places&callback=initialize" async defer></script>
<!-- <script type="text/javascript">
   $(document).ready(function (){
  $("#validate_form").on("submit",function(){
let max_images_check = $(".img_count").find('img').length - 1;
//alert(max_images_check);
if(max_images_check==0){
  $(".custom_error").text("Please upload property image.").show();
  return false;
}

})

   });

</script> -->
<script>
      function initialize() {
         var autocomplete = new google.maps.places.Autocomplete(
         (document.getElementById('autocomplete')), {
            types: ['geocode']
         });
         google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var long = place.geometry.location.lng();
            $('#lat_val').val(lat);
            $('#long_val').val(long);
            // console.log(lat + ", " + long);
         });
      }
      $(document).ready(function () {
        //called when key is pressed in textbox
        $("#quantity").keypress(function (e) {
          //if the letter is not digit then display error and don't type anything
          if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            //display error message
            // $("#errmsg").html("Digits Only").show().fadeOut("slow");
                  return false;
         }
         });
      });

   </script>

<script> 
   var today = new Date();
   $(document).ready(function () {
       $('#datepicker-3').datepicker({
         changeMonth: true,
         changeYear: true,
         minDate: today,
         dateFormat: 'yy-mm-dd'
       });
   
   });
</script>
<script>
   function validateForm(){
   let image = $(".upload_images").val();
          let media_prev = $(".img_count").find('.img').length;
          if(media_prev == 0) {
            $(".custom_error").text("Please upload property image.").show();
            return false
          }
    }
      
</script>
<script type="text/javascript">
   $(document).ready(function(){
      let start_time_val = $("#start_time").val();
      let end_time_val = $("#end_time").val();
   
      $("#start_time").attr("is_valid","true");
      $("#end_time").attr("is_valid","true");
      $("#start_time-error").text("").hide();
      $("#end_time-error").text("").hide();
   
      $("#start_time").on("change",function(){
   
         $("#start_time-error").text("").hide();
   
         /*For Start Time*/
         start_time_val = $(this).val();
         start_time_val = [start_time_val.slice(0,5),':',start_time_val.slice(5)].join('');
   
         let stSplit = start_time_val.split(":");// alert(stSplit);
         let stHour = stSplit[0];
         let stMin = stSplit[1];
         let stAmPm = stSplit[2];
         let newhr = 0;
         let ampm = '';
         let newtime = '';
   
         if(stAmPm=='PM'){ 
   
            if (stHour!=12){
               stHour=stHour*1+12;
            }
       
         }else if(stAmPm=='AM' && stHour=='12'){
   
            stHour = stHour -12;
         }else{
            stHour=stHour;
         }
   
         let final_time_after_convert_start_time = stHour+":"+stMin+":00";
   
   
         /*For End Time*/
   
         end_time_val = $("#end_time").val();
   
         if(end_time_val.length > 0){
   
            end_time_val = [end_time_val.slice(0,5),':',end_time_val.slice(5)].join('');
   
            let stSplit_end = end_time_val.split(":");
            let stHour_end_time = stSplit_end[0];
            let stMin_end_time = stSplit_end[1];
            let stAmPm_end_time = stSplit_end[2];
            let newhr_end_time = 0;
            let ampm_end_time = '';
            let newtime_end_time = '';
   
            if(stAmPm_end_time=='PM'){ 
   
               if (stHour_end_time!=12){
                  stHour_end_time=stHour_end_time*1+12;
               }
          
            }else if(stAmPm_end_time=='AM' && stHour_end_time=='12'){
   
               stHour_end_time = stHour_end_time -12;
            }else{
               stHour_end_time=stHour_end_time;
            }
   
            let final_time_after_convert_end_time = stHour_end_time+":"+stMin_end_time+":00";
   
   
            /*#Check TIME*/
   
               let date_start_time = new Date('January 01, 2021 '+final_time_after_convert_start_time);
               let date_end_time = new Date('January 01, 2021 '+final_time_after_convert_end_time);
   
               if(Date.parse(date_start_time) >= Date.parse(date_end_time)){
                  $("#start_time").attr("is_valid","false");
                  $("#end_time").attr("is_valid","false");
                  $("#start_time-error").text("Start time should be less than end time.").show();
                  return false;
               }else{
                  $("#start_time").attr("is_valid","true");
                  $("#end_time").attr("is_valid","true");
                  $("#start_time-error").text("").hide();
                  $("#end_time-error").text("").hide();
               }
   
   
   
            /*END CHECK TIME*/
   
   
   
   
         }
   
         /**/
   
      });
   
      $("#end_time").on("change",function(){
   
   
         $("#end_time-error").text("").hide();
   
         end_time_val = $(this).val();
   
         end_time_val = [end_time_val.slice(0,5),':',end_time_val.slice(5)].join('');
   
         let stSplit_end = end_time_val.split(":");
         let stHour_end_time = stSplit_end[0];
         let stMin_end_time = stSplit_end[1];
         let stAmPm_end_time = stSplit_end[2];
         let newhr_end_time = 0;
         let ampm_end_time = '';
         let newtime_end_time = '';
   
         if(stAmPm_end_time=='PM'){ 
   
            if (stHour_end_time!=12){
                  stHour_end_time=stHour_end_time*1+12;
            }
          
         }else if(stAmPm_end_time=='AM' && stHour_end_time=='12'){
   
            stHour_end_time = stHour_end_time -12;
         }else{
            stHour_end_time=stHour_end_time;
         }
   
         let final_time_after_convert_end_time = stHour_end_time+":"+stMin_end_time+":00";
   
         start_time_val = $("#start_time").val();
   
         if(start_time_val.length > 0){
   
            start_time_val = [start_time_val.slice(0,5),':',start_time_val.slice(5)].join('');
   
            let stSplit = start_time_val.split(":");// alert(stSplit);
            let stHour = stSplit[0];
            let stMin = stSplit[1];
            let stAmPm = stSplit[2];
            let newhr = 0;
            let ampm = '';
            let newtime = '';
   
            if(stAmPm=='PM'){ 
   
               if (stHour!=12){
                  stHour=stHour*1+12;
               }
          
            }else if(stAmPm=='AM' && stHour=='12'){
   
               stHour = stHour -12;
            }else{
               stHour=stHour;
            }
   
            let final_time_after_convert_start_time = stHour+":"+stMin+":00";
   
   
   
            /*#Check TIME*/
   
            let date_start_time = new Date('January 01, 2021 '+final_time_after_convert_start_time);
            let date_end_time = new Date('January 01, 2021 '+final_time_after_convert_end_time);
   
            if(Date.parse(date_start_time) >= Date.parse(date_end_time)){
               $("#start_time").attr("is_valid","false");
               $("#end_time").attr("is_valid","false");
               $("#end_time-error").text("End time should be greater than start time.").show();
               return false;
            }else{
               $("#start_time").attr("is_valid","true");
               $("#end_time").attr("is_valid","true");
               $("#end_time-error").text("").hide();
               $("#start_time-error").text("").hide();
            }
   
            /*END CHECK TIME*/
         }
   
   
   
      });
   
   
   
      $("#submit_btn").on("click",function(){
   
         $("#start_time-error").text("").hide();
   
         /*For Start Time*/
         start_time_val = $("#start_time").val();
         end_time_val = $("#end_time").val();
   
         if(start_time_val.length == 0){
            $("#start_time-error").text("Please select start time.").show();
         }else{
            $("#start_time-error").text("").hide();
         }
   
         if(end_time_val.length == 0){
            $("#end_time-error").text("Please select end time.").show();
         }else{
            $("#end_time-error").text("").hide();
         }
   
   
         if(start_time_val.length > 0 && end_time_val.length > 0){
            
            start_time_val = [start_time_val.slice(0,5),':',start_time_val.slice(5)].join('');
   
            let stSplit = start_time_val.split(":");// alert(stSplit);
            let stHour = stSplit[0];
            let stMin = stSplit[1];
            let stAmPm = stSplit[2];
            let newhr = 0;
            let ampm = '';
            let newtime = '';
   
            if(stAmPm=='PM'){ 
   
               if (stHour!=12){
                  stHour=stHour*1+12;
               }
          
            }else if(stAmPm=='AM' && stHour=='12'){
   
               stHour = stHour -12;
            }else{
               stHour=stHour;
            }
   
            let final_time_after_convert_start_time = stHour+":"+stMin+":00";
   
   
            /*For End Time*/
   
            
               end_time_val = [end_time_val.slice(0,5),':',end_time_val.slice(5)].join('');
   
               let stSplit_end = end_time_val.split(":");
               let stHour_end_time = stSplit_end[0];
               let stMin_end_time = stSplit_end[1];
               let stAmPm_end_time = stSplit_end[2];
               let newhr_end_time = 0;
               let ampm_end_time = '';
               let newtime_end_time = '';
   
               if(stAmPm_end_time=='PM'){ 
   
                  if (stHour_end_time!=12){
                     stHour_end_time=stHour_end_time*1+12;
                  }
             
               }else if(stAmPm_end_time=='AM' && stHour_end_time=='12'){
   
                  stHour_end_time = stHour_end_time -12;
               }else{
                  stHour_end_time=stHour_end_time;
               }
   
               let final_time_after_convert_end_time = stHour_end_time+":"+stMin_end_time+":00";
   
   
               /*#Check TIME*/
   
                  let date_start_time = new Date('January 01, 2021 '+final_time_after_convert_start_time);
                  let date_end_time = new Date('January 01, 2021 '+final_time_after_convert_end_time);
   
                  if(Date.parse(date_start_time) >= Date.parse(date_end_time)){
                     $("#start_time").attr("is_valid","false");
                     $("#end_time").attr("is_valid","false");
                     $("#start_time-error").text("Start time should be less than end time.").show();
                     $("#end_time-error").text("End time should be greater than start time.").show();
                     return false;
                  }else{
                     $("#start_time").attr("is_valid","true");
                     $("#end_time").attr("is_valid","true");
                     $("#start_time-error").text("").hide();
                     $("#end_time-error").text("").hide();
                  }
   
         }
   
      });
   
   });
</script>

<script type="text/javascript">
   $('.property_type').change(function() {
    if($(this).val() != "") {
      $("#property_type-error").hide();
    } else {
      $("#property_type-error").show();
    }

   })
</script>
<script type="text/javascript">
   $('.bedroom_type').change(function() {
    if($(this).val() != "") {
      $("#number_of_bedroom-error").hide();
    } else {
      $("#number_of_bedroom-error").show();
    }

   })
</script>
<script type="text/javascript">
   $('.bathroom_type').change(function() {
    if($(this).val() != "") {
      $("#number_of_bathroom-error").hide();
    } else {
      $("#number_of_bathroom-error").show();
    }

   })
</script>
<script type="text/javascript">
   $('#datepicker-3').change(function() {
      $("#start_time").val("");
      $("#end_time").val("");
      return false;
      if($(this).val() != "") {
      $("#datepicker-3-error").hide();
      return false;
     } else {
      $("#datepicker-3-error").show();
      return false;
     }

   })
</script>
<script type="text/javascript">
   $('.clockpicker').clockpicker({
     autoclose: true,
     twelvehour: true
   });
   
</script>
<script type="text/javascript">
   $('.clockpicker1').clockpicker({
     autoclose: true,
     twelvehour: true
   });
   
</script>
<script type="text/javascript">
   $.validator.addMethod("notOnlyZero", function (value, element, param) {
       return this.optional(element) || parseInt(value) > 0;
   });
   
   $.validator.addMethod("greaterThan",function (value, element, param) {
          var $otherElement = $(param);
          return parseInt(value, 10) > parseInt($otherElement.val(), 10);
   });
   
   jQuery.validator.addMethod("noSpace", function(value, element) {
      return value.length > 0 ? (value.trim().length == 0 ? false : true) : true
   }, "Space not allowed");
   
   
   
     //validation for input field
   
     //validation for input field
         $('#validate_form').validate({
   
           ignore: [],
   
              rules: {
                 property_type: {
                   required: true   
                 },
                 description:{
                   required : true,
                   maxlength:400,
                   noSpace:true
                 },
                 address: {
                   required: true,
                   maxlength : 150,
                   noSpace:true
                 },
                 property_price: {
                   required: true,
                   number: true,
                   min:1,
                   digits: true,
                   maxlength:8,
                   notOnlyZero: true,
                  noSpace: true 
                 },
                 number_of_bedroom: {
                   required: true
                 },
                 number_of_bathroom: {
                   required: true
                 },
                 tax: {
                   number: true,
                   min:1,
                   digits: true,
                   maxlength:10,
                   notOnlyZero: true,
                  noSpace: true
                 },
                   plot_size: {
                   number: true,
                   min:1,
                   digits: true,
                   maxlength:10,
                   notOnlyZero: true,
                  noSpace: true 
                 },
   
                  building_size: {
                   number: true,
                   min:1,
                   digits: true,
                   maxlength:10,
                   notOnlyZero: true,
                  noSpace: true 
                 },
   
               school_district: {
                maxlength : 50,
                noSpace:true
              },
              
             date : {
               required : true
            
            }
            },
   
                messages: {
                 property_type: {
                   required : "Please select property type."
                 },
                 description:{
                   required : "Please enter property description.",
                   maxlength: 'Description cannot more than 400 Characters.'
                 },
                 address: {
                   required : "Please enter address.",
                   maxlength: 'Address cannot more than 150 Characters.'
                 },
                 property_price: {
                   required: "Please enter property price.",
                   maxlength: "Property price should not be more than 8 digits.",
                   number : "Please enter numbers only.",
                   digits : "Please enter digits only",
                   notOnlyZero: "Property price must be greater than 0",
                 },
                 number_of_bedroom: {
                   required: "Please select number of bedroom."
                 
                 },
                  
                 number_of_bathroom: {
                   required: "Please select number of bathroom."
               
                 },
                   tax: {
                   maxlength: "tax should not be more than 10 digits.",
                   number : "Please enter numbers only.",
                   digits : "Please enter digits only",
                    notOnlyZero: "tax must be greater than 0"
                 },
                  plot_size: {
                   maxlength: "Plot size should not be more than 10 digits.",
                   number : "Please enter numbers only.",
                   digits : "Please enter digits only",
                    notOnlyZero: "Plot size must be greater than 0"
                 },
                  building_size: {
                   maxlength: "Building size should not be more than 10 digits.",
                   number : "Please enter numbers only.",
                   digits : "Please enter digits only",
                   notOnlyZero: "Building size must be greater than 0"
                 },
                 school_district: {
                   maxlength: 'School/district cannot more than 50 Characters.'
                 },
                  
                  date : {
                     required : "Please select date."
                  }
                 
                  },
   
   
   submitHandler: function(form) {    
          let max_images_check = $(".img_count").find('img').length - 1;
           if(max_images_check==0){
         $(".custom_error").text("Please upload property image.").show();
          return false;
           }
             let start_time = $("#start_time").val();
             let end_time = $("#end_time").val();
             if(start_time == "" && end_time =="" ) {
             $("#datepicker-3-error").show();
            return false;
			}
           
            $(".submit").attr("disabled", true);
           
             form.submit();
         }
      })
    setTimeout(function(){
   $(".alert").hide();    
   },4000);
   
</script>


@endsection