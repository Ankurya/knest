
@extends('admin.layout.admin-layout')
@section('title','Subscription Detail')
@section('content')
<div class="content">

                <div class="contnt_heading">
                   <div class="container-fluid">
                        <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><a href="{{route('admin.subscriptionManagement')}}"><span>Subscription Management</span></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>View</span></h5>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card_bg">
                               <h3 class="np-left">Subscription Details</h3>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered card user-listing dataTable no-footer">
                                        <tbody>
                                            <tr>
                                                <td width="200">Name</td>
                                                 <td>{{$data->user->name}}</td>
                                                </tr>
                                                <tr>
                                                <td>Subscription Type</td>
                                                 <td>{{$data->subscription_type}}</td>
                                                </tr>
                                                 <tr>
                                                <td>Subscription Start Date</td>
                                                 <td>{{$data->subscription_start_date}}</td>
                                                </tr>
                                                 <tr>
                                                <td>Transaction ID</td>
                                                 <td>{{$data->transaction_id ?? "N/A"}}</td>
                                                </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <a href="{{url('admin/cancel-subscription').'/'.$data->id}}" class="main-button" style="margin-left: 0px;">Cancel Subscription</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endsection()