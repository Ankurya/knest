<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
    Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
    Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
  -->

      
  <div class="sidebar-wrapper">
                <div class="logo">
                    <figure>
                       <a href="{{route('admin.dashboard')}}" class="simple-text">
                            <img src="{{url('public/admin/assets/img/kush.png')}}">
                        </a>
                    </figure>
                     <div class="logo-text">
                    <h4>Admin</h4>
                </div>

                </div>

            <ul class="nav">
                    <li class="@if(Request::is('admin/dashboard')) active @else @endif()">
                        <a href="{{route('admin.dashboard')}}">
                            <i class="fa fa-dashcube" aria-hidden="true"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
          
                    <li class="@if(Request::is('admin/user-management')  || Request::is('admin/edit-user/*') || Request::is('admin/view-user/*') || Request::is('admin/add-user')) active @else @endif()">
                        <a href="{{route('admin.userManagement')}}">
                          <i class="fa fa-user" aria-hidden="true"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                      <li class="dropdown @if(Request::is('admin/property')  || Request::is('admin/edit-property/*') || Request::is('admin/view-property/*') || Request::is('admin/add-property') || Request::is('admin/new-property-management') || Request::is('admin/new-property-management-view/*')) open active @else @endif()">
                    <a href="javascript:void(0)" class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-home"></i>
                        <p>Property Management</p>
                    <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="@if(Request::is('admin/new-property-management') || Request::is('admin/new-property-management-view')) active @else @endif()"><a href="{{route('admin.newPropertyManagement')}}"><i class="fa fa-plus"></i> <p>New Property Request</p></a></li>
                        <li class="@if(Request::is('admin/property')  || Request::is('admin/edit-property') || Request::is('admin/view-property') || Request::is('admin/add-property')) active @else @endif()"><a href="{{route('admin.property')}}"><i class="fa fa-list"></i> <p>Property</p></a></li>
                      </ul>
                </li>
                     <li class="@if(Request::is('admin/subscription-management') || Request::is('admin/add-subscription') || Request::is('admin/edit-subscription') || Request::is('admin/view-subscription')) active @else @endif()">
                        <a href="{{route('admin.subscriptionManagement')}}">
                  <i class="fa fa-external-link-square" aria-hidden="true"></i>

                        <p>Subscription Management</p>
                        </a>
                    </li>
                     
                      <li class="dropdown @if(Request::is('admin/manage-account')  || Request::is('admin/update-password')) open active @else @endif()">
                    <a href="javascript:void(0)" class="dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-cog"></i>
                        <p>My Account</p>
                    <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li class="@if(Request::is('admin/manage-account')) active @else @endif()"><a href="{{route('admin.manageAccount')}}"><i class="fa fa-envelope" aria-hidden="true"></i><p>Manage Account
                        </p></a></li>
                        <li class="@if(Request::is('admin/update-password')) active @else @endif()"><a href="{{route('admin.updatePassword')}}"><i class="fa fa-key" aria-hidden="true"></i><p>Update Password</p></a></li>
                      </ul>
                </li>

                    <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>

                            <p>Logout</p>
                        </a></li>
                </ul>
            </div>
    </div> 