@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $profile->cover }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">OUR SERVICES</h1>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- Latest News Start -->
    @if ($afterSales)
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-4 justify-content-center">
                    @foreach ($afterSales as $afterSale)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item">
                                <div class="position-relative overflow-hidden img-container">
                                    <img class="img-fluid" src="{{ $afterSale->image }}" alt="">
                                    <div class="team-overlay position-absolute start-0 top-0 w-100 h-100">
                                        <a class="btn mx-1" href="{{ route('after-sales.show', $afterSale->slug) }}">READ MORE <i
                                                class="fa fa-arrow-right ms-3"></i></a>
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
    <!-- Latest News End -->
@endsection
