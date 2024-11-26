<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('homepage') }}" class="brand-link">
        <img src="{{ asset('logo/short-logo.png') }}" alt="" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light"><b class="text-primary">ARMADA</b> <i
                class="text-danger">mobil</i></span>
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('cms.dashboard.index') }}"
                        class="nav-link @if (request()->is('cms/dashboard*')) active @endif">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.profiles.index') }}"
                        class="nav-link @if (request()->is('cms/profiles*')) active @endif">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.services.index') }}"
                        class="nav-link @if (request()->is('cms/services*')) active @endif">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>Service</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.contacts.index') }}"
                        class="nav-link @if (request()->is('cms/contacts*')) active @endif">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>Contact</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.operational-hours.index') }}"
                        class="nav-link @if (request()->is('cms/operational-hours*')) active @endif">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>Operational Hour</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.products.index') }}"
                        class="nav-link @if (request()->is('cms/products*')) active @endif">
                        <i class="nav-icon fas fa-car"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.after-sales.index') }}"
                        class="nav-link @if (request()->is('cms/after-sales*')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>After Sale</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.blogs.index') }}"
                        class="nav-link @if (request()->is('cms/blogs*')) active @endif">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Blog</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.promotions.index') }}"
                        class="nav-link @if (request()->is('cms/promotions*')) active @endif">
                        <i class="nav-icon fas fa-percentage"></i>
                        <p>Promotion</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.outlets.index') }}"
                        class="nav-link @if (request()->is('cms/outlets*')) active @endif">
                        <i class="nav-icon fas fa-store-alt"></i>
                        <p>Outlet</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.banners.index') }}"
                        class="nav-link @if (request()->is('cms/banners*')) active @endif">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Banner</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.testimonials.index') }}"
                        class="nav-link @if (request()->is('cms/testimonials*')) active @endif">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p>Testimonial</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.brochures.index') }}"
                        class="nav-link @if (request()->is('cms/brochures*')) active @endif">
                        <i class="nav-icon fas fa-folder-open"></i>
                        <p>Brochure</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cms.careers.index') }}"
                        class="nav-link @if (request()->is('cms/careers*')) active @endif">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>Career</p>
                    </a>
                </li>
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
