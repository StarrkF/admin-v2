<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('get.admin.dashboard') }}"><img src="{{ asset('assets/images/logo/logo.svg') }}"
                            alt="Logo" srcset=""></a>
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
            <p class="menu">{{ Auth::user()->name . ' [' . Auth::user()->role_name . ']' }}</p>
            <ul class="menu">
                <li class="sidebar-title">{{ __('menus.content') }}</li>

                <li class="sidebar-item">
                    <a href="{{ route('get.admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>{{ __('menus.dashboard') }}</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('get.projects') }}" class='sidebar-link'>
                        <i class="fa-solid fa-layer-group"></i>
                        <span>{{ __('menus.projects') }}</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('get.categories') }}" class='sidebar-link'>
                        <i class="fa-solid fa-layer-group"></i>
                        <span>{{ __('menus.categories') }}</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>{{ __('menus.pages') }}</span>
                    </a>
                    <ul class="submenu ">
                        @foreach ($categories as $category)
                            <li class="submenu-item ">

                                <a href="component-alert.html">
                                    <i class="fa-solid fa-check"></i>
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                <li class="sidebar-title">{{ __('menus.settings') }}</li>

                @can('show-user')
                    <li class="sidebar-item  ">
                        <a href="{{ route('get.users') }}" class='sidebar-link'>
                            <i class="bi bi-person"></i>
                            <span>{{ __('menus.users') }}</span>
                        </a>
                    </li>
                @endcan

                @can('show-role')
                    <li class="sidebar-item  ">
                        <a href="{{ route('get.roles-permissions') }}" class='sidebar-link'>
                            <i class="bi bi-shield-lock"></i>
                            <span>{{ __('menus.roles_permissions') }}</span>
                        </a>
                    </li>
                @endcan

                <li class="sidebar-item  ">
                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="bi bi-box-arrow-right"></i>
                        <span>{{ __('menus.logout') }}</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
