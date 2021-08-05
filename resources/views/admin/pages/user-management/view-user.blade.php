@extends('admin.layout.admin-layout')
@section('title','User Details')
@section('content')

<style>
  td.email {
    word-break: break-all;
}
</style>

            <div class="content">

                <div class="contnt_heading">
                   <div class="container-fluid">
                        <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{route('admin.userManagement')}}"><span>User Management</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>User Details</span></h5>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card_bg">
                               <h3 class="np-left">User Details</h3>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered card user-listing dataTable no-footer">
                                        <tbody>
                                            <tr>
                                                <td width="200">Profile Image</td>
                                                <?php 
                                                if(!empty($user->profile_image)){
                                                  $image = $user->profile_image;
                                                }else{
                                                  $image = url('public/admin/assets/img/user.png');
                                                }

                                                 ?>
                                                <td><img src="{{$image}}" width="100" /></td>
                                            </tr>
                                    
                                            </tr>
                                            <tr>
                                                <td>Name</td>
                                                 <td>{{$user->name}}</td>

                                                </tr>
                                                <tr>
                                                <td>Email Address</td>
                                                 <td class = "email">{{$user->email}}</td>

                                                </tr>
                                                 <tr>
                                                <td>Phone Number</td>
                                                 <td>{{$user->country_code}} {{$user->phone_number}}</td>

                                                </tr>
                                                  <tr>
                                                <td>City</td>
                                                 <td>{{$user->city}}</td>

                                                </tr>
                                                 <tr>
                                                <td>Pin Code</td>
                                                 <td>{{$user->pin_code}}</td>

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