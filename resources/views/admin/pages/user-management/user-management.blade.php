@extends('admin.layout.admin-layout')
<link rel="apple-touch-icon" sizes="76x76" href="{{url('public/admin/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" sizes="96x96" href="{{url('public/admin/assets/img/favicon.png')}}">
@section('title','User Management')
@section('content')

<style type="text/css">
table#example tr th{
      padding: 11px 64px 12px 5px;
}
.col-sm-12 {
    overflow-x: scroll;
}
td.action {
    white-space: nowrap;
}
.content .table-striped.card tbody td .btnlink{
      float: unset;

}
a.btn.btnlink.red {
    width: 93px;
}
.iti{
      width: 100%;

}
th.no-sort.center.sorting_asc,th.no-sort.center.sorting_desc{
  text-align: center;
}

table#example tr th:last-child{
pointer-events: none;
}

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


</style>

        <div class="content">
            
             <div class="contnt_heading">
                 <div class="container-fluid">
                       <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>User Management </span></h5>
                 </div>
                </div>
            <div class="container-fluid">
                <div class="row">
                    @include('admin.layout.notification')
                    <div class="col-lg-12">

                        <div class="card_bg">
                            <h3>User Management</h3>
                            <div class="table-responsive">
                           <a href="{{route('admin.addUser')}}" class="main-button">Add user</a>
                          <table id="example" class="table table-striped table-bordered card user-listing dataTable no-footer" cellspacing="0" width="100%">

        <thead>

            <tr>
                <th class="arrow">Sr. No.</th>
                <th class="arrow">Name</th>
                 <th class="arrow">Email Address</th>
                 <th class="arrow">Phone Number</th>
                <th width="320" class="no-sort center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($users as $user)
            <tr>
            	<td>{{$i}}</td>
                <td>{{$user->name}}</td>
                <td>@if(strlen($user->email) > 150){{substr($user->email,0,100)}}... @else {{substr($user->email,0,100)}} @endif</td>
                <td>{{$user->country_code}} {{$user->phone_number}}</td>
                <td class="action"><a href="{{url('admin/view-user').'/'.base64_encode($user->id)}}" class="btn btnlink">View</a> <a href="{{url('admin/edit-user').'/'.base64_encode($user->id)}}" class="btnlink btn btnlink">Edit</a>

                    @if($user->is_blocked == 0)
                    <a href="{{url('admin/block-user').'/'.base64_encode($user->id)}}" class="btn btnlink red">Block</a>
                    @endif()
                    @if($user->is_blocked == 1)
                    <a href="{{url('admin/block-user').'/'.base64_encode($user->id)}}" class="btn btnlink red">Unblock</a>
                    @endif()
                    <button ui="{{$user->id}}" data-toggle="modal" data-target="#myModal" class="btnlink darkblack del">Delete</button>
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
      <form method="POST" action="{{route('admin.deleteUser')}}">
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