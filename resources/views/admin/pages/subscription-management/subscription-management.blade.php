@extends('admin.layout.admin-layout')
@section('title','Subscription Management')
@section('content')
<div class="content">
            
             <div class="contnt_heading">
                 <div class="container-fluid">
                       <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Subscription Management </span></h5>
                 </div>
                </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">



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


                        <div class="card_bg">
                            <h3>Subscription Management</h3>
                            <div class="table-responsive">
                           <a href="{{route('admin.addSubscription')}}" class="main-button">Add</a>
                          <table id="example" class="table table-striped table-bordered card user-listing dataTable no-footer" cellspacing="0" width="100%">

        <thead>

            <tr>
                <th class="arrow">Sr.No</th>
                 <th class="arrow">Name</th>
                <th class="arrow">Subscription Type</th>
                <th width="320" class="no-sort center">Action</th>
            </tr>
        </thead>


        <tbody>
          <?php
            $i=0;
          ?>
          @foreach($data as $row)
            <tr>
              <td>{{++$i}}</td>
                <td>{{$row->user->name ?? "N/A"}}</td>
                <td>{{$row->subscription_type ?? "N/A"}}</td>
                <td class="action">
                  <a class="btn btnlink" href="{{url('admin/view-subscription').'/'.$row->id}}">View</a>

                  <a class="btn btnlink" href="{{url('admin/edit-subscription').'/'.$row->id}}">Edit</a>

                </td>          
              </tr>
            @endforeach
         
            
           </tbody>
         </table>
                        </div>  
                    </div>
                    </div>

                </div>
            </div>
        </div>
        @endsection()