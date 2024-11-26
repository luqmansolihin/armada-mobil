@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $profile->cover }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">SEARCH</h1>
                <p class="text-white">{{ 'Search result for: ' . $search }}</p>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- Product Start -->
    @if ($products->isNotEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">PRODUCTS!</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="position-relative overflow-hidden img-container">
                                    <img class="img-fluid" src="{{ $product->image }}" alt="">
                                    <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                        <a class="btn mx-1" href="{{ route('products.show', $product->slug) }}">
                                            {{ $product->title }} <i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Latest Product End -->

    <!-- Service Start -->
    @if ($afterSales->isNotEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">SERVICES!</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($afterSales as $afterSale)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="position-relative overflow-hidden img-container">
                                    <img class="img-fluid" src="{{ $afterSale->image }}" alt="">
                                    <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                        <a class="btn mx-1" href="{{ route('after-sales.show', $afterSale->slug) }}">READ
                                            MORE <i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                                <div class="bg-light text-left p-4">
                                    <small>{{ $afterSale->created_at->tz('Asia/Jakarta')->format('F d, Y') }}</small>
                                    <h4 class="fw-bold mb-0">{{ $afterSale->title }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Latest Service End -->

    <!-- News & Events Start -->
    @if ($blogs->isNotEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">NEWS & EVENTS!</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="position-relative overflow-hidden img-container">
                                    <img class="img-fluid" src="{{ $blog->image }}" alt="">
                                    <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                        <a class="btn mx-1" href="{{ route('blogs.show', $blog->slug) }}">READ MORE <i
                                                class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                                <div class="bg-light text-left p-4">
                                    <small>{{ $blog->created_at->tz('Asia/Jakarta')->format('F d, Y') }}</small>
                                    <h4 class="fw-bold mb-0">{{ $blog->title }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Latest News & Events End -->

    <!-- Latest Promotion Start -->
    @if ($promotions->isNotEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">PROMOTIONS!</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($promotions as $promotion)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="position-relative overflow-hidden img-container">
                                    <img class="img-fluid" src="{{ $promotion->image }}" alt="">
                                    <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                        <a class="btn mx-1" href="{{ route('promotions.show', $promotion->slug) }}">READ
                                            MORE <i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                                <div class="bg-light text-left p-4">
                                    <small>{{ $promotion->created_at->tz('Asia/Jakarta')->format('F d, Y') }}</small>
                                    <h4 class="fw-bold mb-0">{{ $promotion->title }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Latest Promotion End -->

    <!-- Outlet Start -->
    @if ($outlets->isNotEmpty())
        <div class="container-xxl service py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">OUTLETS!</h1>
                </div>
                <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-lg-4">
                        <div class="nav w-100 nav-pills me-4">
                            @foreach ($outlets as $outlet)
                                <button
                                    class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 @if ($loop->index == 0) active @endif"
                                    data-bs-toggle="pill" data-bs-target="#tab-pane-{{ $loop->index }}" type="button">
                                    <i class="fa fa-map-marker-alt fa-2x me-3"></i>
                                    <h4 class="m-0">{{ strtoupper($outlet->name) }}</h4>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content w-100">
                            @foreach ($outlets as $outlet)
                                <div class="tab-pane fade @if ($loop->index == 0) show active @endif"
                                    id="tab-pane-{{ $loop->index }}">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <iframe class="position-relative rounded w-100 h-100"
                                                src="{{ $outlet->url_embed_address }}" frameborder="0"
                                                allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                        </div>
                                        <div class="col-md-6">
                                            <h3 class="mb-2"><i class="fa fa-map text-primary me-3"></i>Address</h3>
                                            <p class="mb-2">{{ $outlet->address }}</p>
                                            <h3 class="mb-2"><i class="fa fa-phone text-primary me-3"></i>Phone</h3>
                                            <p class="mb-2">{{ $outlet->phone }}</p>
                                            <h3 class="mb-2"><i class="fa fa-fax text-primary me-3"></i>Fax</h3>
                                            <p class="mb-2">{{ $outlet->fax }}</p>
                                            <h3 class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>Email</h3>
                                            <p class="mb-2">{{ $outlet->email }}</p>
                                            <h3 class="mb-2"><i class="fa fa-clock text-primary me-3"></i>Operational
                                                Hours
                                            </h3>
                                            @foreach ($outlet->outletHasOperationalHours as $outletHasOperationalHour)
                                                <p class="mb-2">
                                                    @if ($outletHasOperationalHour->day_from == $outletHasOperationalHour->day_to)
                                                        {{ $outletHasOperationalHour->day_from . ' :' }}
                                                    @else
                                                        {{ $outletHasOperationalHour->day_from . ' - ' . $outletHasOperationalHour->day_to . ' :' }}
                                                    @endif
                                                    {{ Carbon\Carbon::parse($outletHasOperationalHour->open_time)->format('H:i') . ' - ' . Carbon\Carbon::parse($outletHasOperationalHour->close_time)->format('H:i') }}
                                                </p>
                                            @endforeach
                                            <h3 class="mb-2"><i
                                                    class="fa fa-hand-holding-heart text-primary me-3"></i>Our
                                                Services</h3>
                                            <p class="mb-2">
                                                @foreach ($outlet->outletHasServices as $outletHasService)
                                                    <i
                                                        class="{{ $outletHasService->service->icon }} text-primary @if ($loop->index > 0) ms-3 @endif me-3"></i>{{ $outletHasService->service->title }}
                                                @endforeach
                                            </p>
                                            <a href="{{ $outlet->url_address }}" class="btn btn-primary py-3 px-5 mt-3"
                                                target="_blank">View Larger Map<i
                                                    class="fa fa-location-arrow ms-3"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Outlet End -->

    <!-- Career Start -->
    @if ($careers->isNotEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">CAREERS!</h1>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach ($careers as $career)
                        <div class="col-md-12">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <div class="row">
                                    <div class="col-md-5 my-2">
                                        <h5 class="text-uppercase">{{ strtoupper($career->name) }}</h5>
                                        <p class="m-0">
                                            @foreach ($career->careerPlacements as $careerPlacement)
                                                <i
                                                    class="fa @if ($loop->index == 0) fa-map-marker-alt @else fa-circle fa-xs @endif text-primary me-2"></i>
                                                {{ ucwords(strtolower($careerPlacement->city->name)) }}
                                            @endforeach
                                        </p>
                                    </div>
                                    <div class="col-md-4 my-2">
                                        <h5 class="text-uppercase">Tanggal Pendaftaran</h5>
                                        <p class="m-0">
                                            <i class="fa fa-calendar-alt text-primary me-2"></i>
                                            {{ Carbon\Carbon::parse($career->registration_from)->format('d F Y') . ' - ' . Carbon\Carbon::parse($career->registration_to)->format('d F Y') }}
                                        </p>
                                    </div>
                                    <div class="col-md-3 text-center my-2">
                                        <a href="{{ route('careers.show', $career->slug) }}"
                                            class="btn btn-primary py-3 px-5">
                                            <h5 class="text-white">View Detail</h5>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Career End -->

    <!-- 404 Start -->
    @if (
        $products->isEmpty() and
            $afterSales->isEmpty() and
            $blogs->isEmpty() and
            $promotions->isEmpty() and
            $outlets->isEmpty() and
            $careers->isEmpty())
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                        <h1 class="display-1">404</h1>
                        <h1 class="mb-4">RECORD NOT FOUND</h1>
                        <p class="mb-4">We’re sorry, the search you have looked for does not exist in our website! Maybe
                            go
                            to our home page or try to use another search?</p>
                        <a class="btn btn-primary rounded-pill py-3 px-5" href="/">Go Back To Home</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- 404 End -->
@endsection
