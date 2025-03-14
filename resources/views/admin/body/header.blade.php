 <div class="navbar-custom">
     <div class="container-fluid">
         <ul class="list-unstyled topnav-menu float-end mb-0">

             <li class="d-none d-lg-block">
                 <form class="app-search">
                     <div class="app-search-box dropdown">
                         <div class="input-group">
                             <input type="search" class="form-control" placeholder="Search..." id="top-search">
                             <button class="btn input-group-text" type="submit">
                                 <i class="fe-search"></i>
                             </button>
                         </div>
                         <div class="dropdown-menu dropdown-lg" id="search-dropdown">
                             <!-- item-->
                             <div class="dropdown-header noti-title">
                                 <h5 class="text-overflow mb-2">Found 22 results</h5>
                             </div>

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item">
                                 <i class="fe-home me-1"></i>
                                 <span>Analytics Report</span>
                             </a>

                             <!-- item-->
                             <a href="javascript:void(0);" class="dropdown-item notify-item">
                                 <i class="fe-aperture me-1"></i>
                                 <span>How can I help you?</span>
                             </a>


                         </div>
                     </div>
                 </form>
             </li>





             <li class="dropdown d-none d-lg-inline-block">
                 <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                     href="#">
                     <i class="fe-maximize noti-icon"></i>
                 </a>
             </li>




             <li class="dropdown notification-list topbar-dropdown">
                 <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#"
                     role="button" aria-haspopup="false" aria-expanded="false">
                     <i class="fe-bell noti-icon"></i>
                     <span class="badge bg-danger rounded-circle noti-icon-badge">0</span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                     <!-- item-->
                     <div class="dropdown-item noti-title">
                         <h5 class="m-0">
                             <span class="float-end">
                                 <a href="" class="text-dark">
                                     <small>Clear All</small>
                                 </a>
                             </span>Notification
                         </h5>
                     </div>

                     <div class="noti-scroll" data-simplebar>



                         <!-- item-->



                         @forelse($massages as $notifiaction)
                             <!-- item-->
                             <a href="#" class="dropdown-item notify-item">
                                 <div class="notify-icon bg-secondary">
                                     <i class="mdi mdi-heart"></i>
                                 </div>
                                 <p class="notify-details">{{ $notifiaction->message }}
                                     <b>Admin</b>
                                     <small class="text-muted">
                                         {{ Carbon\Carbon::parse($notifiaction->created_at)->diffForHumans() }} </small>
                                 </p>
                             </a>
                         @empty
                         @endforelse

                     </div>



                     <!-- All-->
                     <a href="javascript:void(0);"
                         class="dropdown-item text-center text-primary notify-item notify-all">
                         View all
                         <i class="fe-arrow-right"></i>
                     </a>

                 </div>
             </li>

             @php

                 $id = Auth::user()->id;
                 $adminData = App\Models\User::find($id);
             @endphp


             <li class="dropdown notification-list topbar-dropdown">
                 <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                     href="#" role="button" aria-haspopup="false" aria-expanded="false">
                     <img src="{{ !empty($adminData->photo) ? url('upload/admin_images/' . $adminData->photo) : url('upload/no_image.jpg') }} "
                         alt="user-image" class="rounded-circle">
                     <span class="pro-user-name ms-1">
                         {{ $adminData->name }} <i class="mdi mdi-chevron-down"></i>
                     </span>
                 </a>
                 <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                     <!-- item-->
                     <div class="dropdown-header noti-title">
                         <h6 class="text-overflow m-0">Welcome !</h6>
                     </div>

                     <!-- item-->
                     <a href="{{ route('admin.profile') }}" class="dropdown-item notify-item">
                         <i class="fe-user"></i>
                         <span>My Account</span>
                     </a>

                     <!-- item-->
                     <a href="javascript:void(0);" class="dropdown-item notify-item">
                         <i class="fe-settings"></i>
                         <span>Settings</span>
                     </a>

                     <!-- item-->
                     <a href="{{ route('admin.change.password') }}" class="dropdown-item notify-item">
                         <i class="fe-lock"></i>
                         <span>Change Password</span>
                     </a>

                     <div class="dropdown-divider"></div>

                     <!-- item-->
                     <a href="{{ route('admin.logout') }}" class="dropdown-item notify-item">
                         <i class="fe-log-out"></i>
                         <span>Logout</span>
                     </a>

                 </div>
             </li>


         </ul>

         <!-- LOGO -->
         <div class="logo-box">
             <a href="index.html" class="logo logo-dark text-center">
                 <span class="logo-sm">
                     <img src="{{ asset($personal->logo) }}" alt="" height="22">
                 </span>
                 <span class="logo-lg">
                     <img src="{{ asset($personal->logo) }}" alt="" height="20">
                 </span>
             </a>

             <a href="index.html" class="logo logo-light text-center">
                 <span class="logo-sm">
                     <img src="{{ asset($personal->logo) }}" alt="" height="22">
                 </span>
                 <span class="logo-lg">
                     <img src="{{ asset($personal->logo) }}" alt="" height="20">
                 </span>
             </a>
         </div>

         <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
             <li>
                 <button class="button-menu-mobile waves-effect waves-light">
                     <i class="fe-menu"></i>
                 </button>
             </li>

             <li>
                 <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                     <div class="lines">
                         <span></span>
                         <span></span>
                         <span></span>
                     </div>
                 </a>
             </li>
             
         </ul>
         <div class="clearfix"></div>
     </div>
 </div>
