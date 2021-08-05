@extends('admin.layout.admin-layout')
@section('title','Property Details')
@section('content')

<style type="text/css">
    .new-uir img {
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
        border: 1px solid lightgray;
            margin: 3px;


}
td.address {
    word-break: break-all;
}
    .form-group{
        margin-bottom: 0;
    overflow: hidden;
    border: 1px solid #000;
    border-radius: 3px;
}
.card_bg .field .form-control{
    border-radius: 0px;
    border:none;
}
</style>
<div class="content">

                <div class="contnt_heading">
                   <div class="container-fluid">
                        <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="javascript:void(0);"><span>Property Management</span></a><i class="fa fa-angle-right" aria-hidden="true"></i>
                            <a href="{{route('admin.newPropertyManagement')}}"><span>New Property Request</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Property Details</span></h5>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card_bg">
                               <h3 class="np-left">Property Details</h3>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered card user-listing dataTable no-footer">
                                        <tbody>
                                           <tr>
                                                <td width="200"> Property Image</td>
                                                <td class="new-point"><div class="new-uir">
                                             <?php $count = 0; ?>
                                             @foreach($profile as $photo)
                                             @php ($urls = $photo->profile ? url($photo->profile) : url('public/admin/assets/img/add_image.png'))
                                            
                                                <img src='{{$urls}}' id="{{$photo->id}}" width = "100px;" /> 
                                            
                                             <?php $count++ ?>
                                             @endforeach
                                          </div>
                                             </td>
                                            </tr>
                                           
                                            
                                            <tr>
                                                 <?php if(!empty($property_find->type == "user")){
                                                    $name = ucfirst($property_find->users->name);    
                                                }else{
                                                  $name = "Admin";  
                                                }
                                                ?>
                                                <td>Property Owner </td>
                                               
                                                 <td>{{$name}}</td>
                                                
                                                </tr>
                                            
                                            <tr>
                                                <td>Property Type</td>
                                                 <td>@if(!empty($property_find->property_type)){{$property_find->property_type}} @else N/A @endif</td>

                                                </tr>
                                                <tr>
                                                <td>Property Price</td>
                                                 <td>@if(!empty($property_find->property_price))$ {{$property_find->property_price}} @else N/A @endif</td>

                                                </tr>
                                                 <tr>
                                                <td>Number Of Bedroom</td>
                                                 <td>@if(!empty($property_find->number_of_bedroom)){{$property_find->number_of_bedroom}} @else N/A @endif</td>

                                                </tr>
                                                 <tr>
                                                <td>Number Of Bathroom</td>
                                                 <td>@if(!empty($property_find->number_of_bathroom)){{$property_find->number_of_bathroom}} @else N/A @endif</td>

                                                </tr>
                                                  <tr>
                                                <td><div class="propert_new">Address</div></td>
                                                 <td class = "address">@if(!empty($property_find->address)){{$property_find->address}} @else N/A @endif</td>

                                                </tr>
                                                <tr>
                                                <td>Date</td>
                                                 <td>@if(!empty($property_find->date)){{$property_find->date}} @else N/A @endif</td>
                                                </tr> 
                                                <tr>
                                                <td>Start Time</td>
                                                 <td>@if(!empty($property_find->start_time)){{$property_find->start_time}} @else N/A @endif</td>
                                                </tr> 
                                                <tr>
                                                <td>End Time</td>
                                                 <td>@if(!empty($property_find->end_time)){{$property_find->end_time}} @else N/A @endif</td>
                                                </tr>
                                                 
                                                 <tr>
                                                <td>Tax</td>
                                                 <td>@if(!empty($property_find->tax)){{$property_find->tax}} @else N/A @endif</td>
                                                </tr> 
                                                 <tr>
                                                <td>Plot Size</td>
                                                 <td>@if(!empty($property_find->plot_size)){{$property_find->plot_size}} @else N/A @endif</td>
                                                </tr>  
                                                <tr>
                                                <td>Building Size</td>
                                                 <td>@if(!empty($property_find->building_size)){{$property_find->building_size}} @else N/A @endif</td>
                                                </tr> 
                                                <tr>
                                                <td>School/District</td>
                                                 <td>@if(!empty($property_find->school_district)){{$property_find->school_district}} @else N/A @endif</td>
                                                </tr> 
                                                  <tr>
                                                <td>Description</td>
                                                <td>
                                               <div class="field cursor"><div class="form-group"><textarea class="form-control cursor" style="height: 150px;" placeholder="Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet." disabled="">@if(!empty($property_find->description)){{$property_find->description}} @else N/A @endif</textarea><span class="material-input"></span></div>
                                           </div>
                                                    <!-- <div class="text-good">
                                                        <h3>Words:15/1500</h3>
                                                    </div> -->
                                                </td>
                                                </tr>   
                                    
                                          
                                                <tr>
                                                    <td></td>
                                                    <td><a href="{{url('admin/AcceptPropertyRequest/'.$property_find->id)}}" class="btn btnlink main-button">Accept</a><a href="{{url('admin/RejectPropertyRequest/'.$property_find->id)}}" class="btn btnlink main-button">Reject</a></td>
                                                </tr>     
                                              

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endsection()