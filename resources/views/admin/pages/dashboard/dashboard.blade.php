@extends('admin.layout.admin-layout')
@section('title','Dashboard')
@section('content')
<div class="content">
                <div class="contnt_heading">
                    <div class="container-fluid">
                        <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Dashboard </span></h5>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        @include('admin.layout.notification')
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <a href="{{route('admin.userManagement')}}">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="icon-big icon-warning text-center">
                                                  <i class="fa fa-user" aria-hidden="true"></i>
                                                </div>
                                                <hr />
                                            </div>
                                            <div class="col-xs-12 footer">
                                                <div class="numbers stats">
                                                    <p>User Management</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <a href="{{route('admin.newPropertyManagement')}}">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="icon-big icon-warning text-center">
                                                   <i class="fa fa-home" aria-hidden="true"></i>

                                                </div>
                                                <hr />
                                            </div>
                                            <div class="col-xs-12 footer">
                                                <div class="numbers stats">
                                                    <p>Property Management</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div> 
                            </div>
                        </div>
                         <div class="col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <a href="{{route('admin.subscriptionManagement')}}">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="icon-big icon-warning text-center">
                                                   <i class="fa fa-external-link-square" aria-hidden="true"></i>

                                                </div>
                                                <hr />
                                            </div>
                                            <div class="col-xs-12 footer">
                                                <div class="numbers stats">
                                                    <p>Subscription Management</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                                    
                       <!--   <div class="col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <a href="offer-management.html">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="icon-big icon-warning text-center">
                                                     <i class="fa fa-trophy" aria-hidden="true"></i>

                                                </div>
                                                <hr />
                                            </div>
                                            <div class="col-xs-12 footer">
                                                <div class="numbers stats">
                                                    <p>Offer Management</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div> -->
                        

                </div>
            </div>


        </div>
@endsection()
@section('js')
<script type="text/javascript">
    // $(document).ready(function() {

    //     demo.initChartist();

    //     $.notify({
    //         icon: 'ti-gift',
    //         message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."

    //     }, {
    //         type: 'success',
    //         timer: 4000
    //     });

    // });

</script>

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
@endsection()
