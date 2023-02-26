<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('get.admin.dashboard') }}"><img src="{{ asset('assets/images/logo/logo.svg') }}" alt="Logo" srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <x-svg-icon type="light-switch" />
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                        <label class="form-check-label"></label>
                    </div>
                    <x-svg-icon type="dark-switch" />
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <p class="menu">{{ Auth::user()->name." [".Auth::user()->role_name."]" }}</p>
            <p class="menu">{{ Auth::user()->permission_names }}</p>
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="component-alert.html">Alert</a>
                        </li>
                    </ul>
                </li>



                <li class="sidebar-title">Raise Support</li>

                @can('show-user')
                <li class="sidebar-item  ">
                    <a href="{{ route('get.users') }}" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span>Users</span>
                    </a>
                </li>
                @endcan

                @can('show-user')
                <li class="sidebar-item  ">
                    <a href="{{ route('get.users') }}" class='sidebar-link'>
                        <i class="bi bi-shield-lock"></i>
                        <span>Roles</span>
                    </a>
                </li>
                @endcan

                <li class="sidebar-item  ">
                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>


