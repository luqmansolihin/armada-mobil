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
            <a href="{{ route('products.index') }}" class="nav-item nav-link">Our Products</a>
            <a href="{{ route('blogs.index') }}" class="nav-item nav-link">News</a>
            <a href="#" class="nav-item nav-link">Promotion</a>
            <a href="#" class="nav-item nav-link">Career</a>
            <a href="{{ route('profile') }}" class="nav-item nav-link">About Us</a>
        </div>
    </div>

    <a href="/" class="navbar-brand d-none d-lg-flex d-xl-flex align-items-center px-4">
        <img src="{{ asset('logo/isuzu-logo.png') }}" width="150">
    </a>
</nav>
<!-- Navbar End -->
