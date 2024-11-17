@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $profile->cover }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">TENTANG ARMADA MOBIL</h1>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            {!! $profile->description !!}
        </div>
    </div>
    <!-- About End -->

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

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-5">OUR SERVICES</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($services as $service)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="d-flex py-5 px-4">
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
@endsection
