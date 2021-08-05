@extends('admin.layout.admin-layout')
@section('title','Property')
<link rel="apple-touch-icon" sizes="76x76" href="{{url('public/admin/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{url('public/admin/assets/img/favicon.png')}}">
@section('content')
<style>
      #myModal button.btn.btnlink.red {
    color: #fff;
    border: transparent;
}
#myModal button.btn.btnlink {
   
    background-color: #4486c6;
    color: #fff;
    border: transparent;
}
.modal-dialog {
    max-width: 400px;
    margin: 30px auto;
}
.propert_new {
    word-break: break-all;
    width: 331px;
}
  </style>

<div class="content">
               <div class="contnt_heading">
                  <div class="container-fluid">
                     <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Property Management </span>
                        <i class="fa fa-angle-right" aria-hidden="true"></i><span>Property </span>
                     </h5>
                  </div>
               </div>
               <div class="container-fluid">
                  <div class="row">
                      @include('admin.layout.notification')
                     <div class="col-lg-12">
                        <div class="card_bg">
                           <h3>Property</h3>
                           <a href="{{route('admin.addProperty')}}" class="main-button">Add</a>
                           
                           <div class="table-responsive">
                              <table id="example" class="table table-striped table-bordered card user-listing dataTable no-footer" cellspacing="0" width="100%">
                                 <thead>
                                    <tr>
                                       <th class="arrow">Sr. No.</th>
                                       <th class="arrow" width="200">Property Type</th>
                                       <th class="arrow">Price</th>
                                       <th class="arrow">Address</th>
                                       <th width="320" class="no-sort center">Action</th>
                                    </tr>
                                 </thead>
                                 <tbody> 
                                  <?php $i = 1; ?>
                              @foreach($property as $properties)
                              <tr>
                                 <td>{{$i}}</td>
                                  <td>{{$properties->property_type}}</td>
                                  <td>${{$properties->property_price}}</td>
                                  <td><div class="propert_new">{{$properties->address}}</div></td>
                                  <td class="action">
                                    <div class="new-button">

                                    <a href="{{url('admin/view-property').'/'.base64_encode($properties->id)}}" class="btn btnlink">View</a> <a href="{{url('admin/edit-property').'/'.base64_encode($properties->id)}}" class="btnlink btn btnlink">Edit</a>
                                      <button ui="{{$properties->id}}" data-toggle="modal" data-target="#myModal" class="btnlink darkblack del">Delete</button>
                                    </div>
                                  </td>
                              </tr>
                              <?php $i++; ?>
                              @endforeach()
                               
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
          @endsection()

@section('js')
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form method="POST" action="{{route('admin.deleteProperty')}}">
        {{@csrf_field()}}
    
      <div class="modal-body">
        <p style="text-align: center; font-size: 20px;margin-bottom: 0;">Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <input type="hidden" name="user_id" id="user_id">
        <button type="submit" class="btn btnlink red">Delete</button>
        <button type="button" class="btn btnlink" data-dismiss="modal">Cancel</button>
      </div>
    </form>
    </div>

  </div>
</div>

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

   <script type="text/javascript">
     $('.del').bind('click', function() {
            var i = $(this).attr('ui');
            $('#user_id').val(i);
    
        });
   </script>

@endsection()