@php
    $id = Auth::user()->id;
    $userid = App\Models\User::find($id);
    $status = $userid->status;
@endphp

<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->


        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>


                <li class="menu-title mt-2">Menu</li>


                {{-- @if (Auth::user()->can('category.menu')) --}}
                <li>
                    <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Category </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="nav-second-level">
                            {{-- @if (Auth::user()->can('category.list')) --}}
                            <li>
                                <a href="{{ route('all.category') }}">All Category</a>
                            </li>
                            {{-- @endif --}}
                            {{-- @if (Auth::user()->can('category.add')) --}}
                            <li>
                                <a href="{{ route('add.category') }}">Add Category</a>
                            </li>
                            {{-- @endif --}}

                        </ul>
                    </div>
                </li>
                {{-- @endif --}}
                {{-- <li>
                        <a href="#banner" data-bs-toggle="collapse">
                            <i class="mdi mdi-cart-outline"></i>
                            <span> Banner  </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="banner">
                            <ul class="nav-second-level">

                                <li>
                                    <a href="{{ route('banner.index') }}">All Banner</a>
                                </li>

                            </ul>
                        </div>
                    </li> --}}
                <li>
                    <a href="#request" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Request </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="request">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('deposit_request.all') }}">Deposit Request</a>
                            </li>

                        </ul>
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('withdrow_request.all') }}">Withdrow Request</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#payment_method" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Payment Method </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="payment_method">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('payment_method_type.index') }}">Payment Method Type</a>
                            </li>
                            <li>
                                <a href="{{ route('payment_method.index') }}">All Payment Method</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#post" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Post </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="post">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('post.index') }}">All Post</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#massage" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Massagenger </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="massage">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('massage.index') }}">Inbox</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#contact_massages" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span> Contract Massages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="contact_massages">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('contact_massages') }}">All Contract Massages</a>
                            </li>

                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#about_us" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span>Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="about_us">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('about_us.index') }}">About Us</a>
                            </li>

                        </ul>
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('privacy.index') }}">Privacy Policy</a>
                            </li>

                        </ul>
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('terms.index') }}">Terms & Condition</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#personal" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span>Company Information </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="personal">
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('all.admin') }}">Admin</a>
                            </li>

                        </ul>
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('all.user') }}">User</a>
                            </li>

                        </ul>
                        <ul class="nav-second-level">

                            <li>
                                <a href="{{ route('personal.index') }}">Personal</a>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
