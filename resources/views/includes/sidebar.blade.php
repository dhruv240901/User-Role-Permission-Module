<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- User profile -->
        <div class="user-profile">
            <!-- User profile image -->
            <div class="profile-img"> <img src="{{ asset('assets/images/users/profile-icon.svg') }}" alt="user" /> </div>
            <!-- User profile text-->
            <div class="profile-text">
                <a href="#" >{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
                {{-- <div class="dropdown-menu animated flipInY">
                    <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                    <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                    <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                    <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                    <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                </div> --}}
                {{-- <a href="#">{{ auth()->user()->name }}</a> --}}
            </div>
        </div>
        <!-- End User profile text-->
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="" href="{{ route('index') }}" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li>
                    <a class="" href="{{ route('user-list') }}" aria-expanded="false"><i class="bi bi-people"></i><span class="hide-menu">Users</span></a>
                </li>
                <li>
                    <a class="" href="{{ route('role-list') }}" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Roles</span></a>
                </li>
                <li>
                    <a class="" href="{{ route('permission-list') }}" aria-expanded="false"><i class="bi bi-unlock"></i><span class="hide-menu">Permissions</span></a>
                </li>
                <li>
                    <a class="" href="{{ route('module-list') }}" aria-expanded="false"><i class="bi bi-box"></i><span class="hide-menu">Modules</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
    {{-- <div class="sidebar-footer">
        <!-- item-->
        <a href="#" class="link" data-toggle="tooltip" title="Settings"><i class="ti-settings"></i></a>
        <!-- item-->
        <a href="#" class="link" data-toggle="tooltip" title="Email"><i class="mdi mdi-gmail"></i></a>
        <!-- item-->
        <a href="#" class="link" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
    </div> --}}
    <!-- End Bottom points-->
</aside>
