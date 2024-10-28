<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('homepage') }}" class="brand-link">
        <img src="{{ asset('logo/short-logo.png') }}" alt="" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"><b class="text-primary">ARMADA</b> <i class="text-danger">mobil</i></span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/user.png') }}" class="img-circle elevation-2" alt="">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('cms.dashboard.index') }}" class="nav-link @if(request()->is('cms/dashboard*')) active @endif">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.banners.index') }}" class="nav-link @if(request()->is('cms/banners*')) active @endif">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Banner</p>
                    </a>
                </li>
{{--                <li class="nav-item @if(request()->is('medicines*') OR request()->is('patients*')) menu-open @endif">--}}
{{--                    <a href="#" class="nav-link @if(request()->is('medicines*') OR request()->is('patients*')) active @endif">--}}
{{--                        <i class="nav-icon fas fa-database"></i>--}}
{{--                        <p>--}}
{{--                            Master--}}
{{--                            <i class="right fas fa-angle-left"></i>--}}
{{--                        </p>--}}
{{--                    </a>--}}
{{--                    <ul class="nav nav-treeview">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('medicines.index') }}" class="nav-link @if(request()->is('medicines*')) active @endif">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Medicine</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a href="{{ route('patients.index') }}" class="nav-link @if(request()->is('patients*')) active @endif">--}}
{{--                                <i class="far fa-circle nav-icon"></i>--}}
{{--                                <p>Patient</p>--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="nav-link text-left btn" style="color: #c2c7d0;">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside>
