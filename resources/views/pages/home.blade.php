@extends('layouts.app')

@section('content')
    <!-- Carousel Start -->
    @if ($banners)
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($banners as $banner)
                        <div class="carousel-item @if ($loop->iteration == 1) active @endif">
                            <img class="w-100" src="{{ $banner->image }}" alt="Image">
                            <div class="carousel-caption d-flex align-items-center">
                                <div class="container">
                                    <div class="row align-items-center justify-content-center justify-content-lg-start">
                                        <div class="col-10 col-lg-7 text-center text-lg-start">
                                            <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">
                                                {{ $banner->title }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    @endif
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 pt-4" style="min-height: 400px;">
                    <div class="position-relative h-100 wow fadeIn" data-wow-delay="0.1s">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ $profile->cover }}"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-4"> ABOUT <span class="text-primary">ARMADA MOBIL</span> </h1>
                    <p class="mb-4">{{ $profile->short_description }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">OUR SERVICES</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="d-flex @if($loop->index%2 != 0) bg-light @endif py-5 px-4">
                            <i class="{{ $service->icon }} fa-3x text-primary flex-shrink-0"></i>
                            <div class="ps-4">
                                <h4 class="mb-3">{{ strtoupper($service->title) }}</h4>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Latest Product Start -->
    @if ($products)
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">LATEST PRODUCTS!</h1>
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

    <!-- Testimonial Start -->
    @if ($testimonials)
        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
            <div class="container">
                <div class="text-center">
                    <h1 class="mb-5">TESTIMONIALS!</h1>
                </div>
                <div class="owl-carousel testimonial-carousel position-relative">
                    @foreach ($testimonials as $testimonial)
                        <div class="testimonial-item text-center">
                            <img class="bg-light rounded-circle p-2 mx-auto mb-3" src="{{ $testimonial->image }}"
                                style="width: 80px; height: 80px;">
                            <h5 class="mb-0">{{ $testimonial->name }}</h5>
                            <p>{{ $testimonial->profession }}</p>
                            <div class="testimonial-text bg-light text-center p-4">
                                <p class="mb-0">{{ $testimonial->testimonial }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    <!-- Testimonial End -->

    <!-- Latest News Start -->
    @if ($blogs)
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5">LATEST NEWS!</h1>
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
    <!-- Latest News End -->
@endsection
