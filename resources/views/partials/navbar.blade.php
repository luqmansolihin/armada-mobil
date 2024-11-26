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
            <a href="/" class="nav-item nav-link">
                <h5>Home</h5>
            </a>
            <a href="{{ route('products.index') }}" class="nav-item nav-link">
                <h5>Product</h5>
            </a>
            <a href="{{ route('after-sales.index') }}" class="nav-item nav-link">
                <h5>Service</h5>
            </a>
            <a href="{{ route('blogs.index') }}" class="nav-item nav-link">
                <h5>News</h5>
            </a>
            <a href="{{ route('promotions.index') }}" class="nav-item nav-link">
                <h5>Promotions</h5>
            </a>
            <a href="{{ route('outlets') }}" class="nav-item nav-link">
                <h5>Outlet</h5>
            </a>
            <a href="{{ route('careers.index') }}" class="nav-item nav-link">
                <h5>Career</h5>
            </a>
            <a href="{{ route('profile') }}" class="nav-item nav-link">
                <h5>About Us</h5>
            </a>

            <!-- Kolom Pencarian di Tengah -->
            <form class="form-inline d-flex align-items-center me-auto" action="{{ route('homepage') }}" method="GET">
                <div class="position-relative mx-auto">
                    <input class="form-control w-100 py-3 ps-4 pe-5" type="text" name="s" placeholder="Search"
                        required>
                    <button type="submit" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2"><i
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
