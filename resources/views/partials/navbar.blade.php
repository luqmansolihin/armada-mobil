<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="/" class="navbar-brand d-flex align-items-center px-4">
        <img src="{{ asset('logo/logo.png') }}" width="150">
    </a>

    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="/" class="nav-item nav-link">Home</a>
            <a href="{{ route('products.index') }}" class="nav-item nav-link">Product</a>
            <a href="#" class="nav-item nav-link">Service</a>
            <a href="{{ route('blogs.index') }}" class="nav-item nav-link">News</a>
            <a href="#" class="nav-item nav-link">Outlet</a>
            <a href="#" class="nav-item nav-link">Career</a>
            <a href="{{ route('profile') }}" class="nav-item nav-link">About Us</a>

            <!-- Kolom Pencarian di Tengah -->
            <form class="form-inline d-flex align-items-center me-auto" action="#" method="GET">
                <div class="position-relative mx-auto">
                    <input class="form-control w-100 py-3 ps-4 pe-5" type="text" placeholder="Search">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2"><i
                            class="fas fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <a href="/" class="navbar-brand d-none d-lg-flex d-xl-flex align-items-center px-4">
        <img src="{{ asset('logo/isuzu-logo.png') }}" width="150">
    </a>
</nav>
<!-- Navbar End -->
