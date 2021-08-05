@extends('admin.layout.admin-layout') @section('title','Property Management') @section('content')
<style>
  .content .table-striped.card tbody td .btnlink {
    float: none;
}
</style>
<div class="content">
  <div class="contnt_heading">
    <div class="container-fluid">
      <h5><a href="{{route('admin.dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i></a><i class="fa fa-angle-right" aria-hidden="true"></i><span>Property Management </span><i class="fa fa-angle-right" aria-hidden="true"></i><span>New Property Request </span></h5> </div>
  </div>
  <div class="container-fluid">
    <div class="row"> @include('admin.layout.notification')
      <div class="col-lg-12">
        <div class="card_bg">
          <h3>New Property Request</h3>
          <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered card user-listing dataTable no-footer" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th class="arrow">Sr. No.</th>
                  <th class="arrow">Property Type</th>
                  <th class="arrow">Price</th>
                  <th class="arrow">Address</th>
                  <th width="320" class="no-sort center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?> @foreach($property as $properties)
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$properties->property_type}}</td>
                    <td>${{$properties->property_price}}</td>
                    <td>
                      <div class="propert_new">{{$properties->address}}</div>
                    </td>
                    <td class="action"><span> <a href="{{url('admin/new-property-management-view').'/'.base64_encode($properties->id)}}" class="btn btnlink">View</a></span> </td>
                  </tr>
                  <?php $i++; ?> @endforeach() </tbody>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection()