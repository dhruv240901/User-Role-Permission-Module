<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <!-- ============================================================== -->
        <!-- Logo -->
        <!-- ============================================================== -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">
                <!-- Logo icon -->
                <b>
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('assets/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo icon -->
                    <img src="{{ asset('assets/images/logo-light-icon.png')}}" alt="homepage" class="light-logo" />
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span>
                    <!-- dark Logo text -->
                    <img src="{{ asset('assets/images/logo-text.png')}}" alt="homepage" class="dark-logo" />
                    <!-- Light Logo text -->
                    <img src="{{ asset('assets/images/logo-light-text.png')}}" class="light-logo" alt="homepage" /></span> </a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav mr-auto mt-md-0 ">
                @auth
                <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="icon-arrow-left-circle"></i></a> </li>
                @endauth

            </ul>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <ul class="navbar-nav my-lg-0">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                src="{{asset('assets/images/users/profile-icon.svg')}}" alt="user" class="profile-pic" /></a>
                        <div class="dropdown-menu dropdown-menu-right animated flipInY">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="{{asset('assets/images/users/profile-icon.svg')}}" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
                                            <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View
                                                Profile</a>
                                        </div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('user-profile') }}"><i class="ti-user"></i> My Profile</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('user-view-change-password') }}"><i class="ti-settings"></i> Change
                                        Password</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-success">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('signup') }}" class="btn btn-danger mx-1">Sign Up</a>
                    </li>
                @endguest

            </ul>
        </div>
    </nav>
</header>
