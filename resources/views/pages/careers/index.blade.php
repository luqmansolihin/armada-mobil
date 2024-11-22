@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $profile->cover }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">CAREERS</h1>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- Career Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-12">
                    <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-md-5 my-2">
                                <h5 class="text-uppercase">IT Support</h5>
                                <p class="m-0">
                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>Magelang
                                    <i class="fa fa-circle fa-xs text-primary me-2"></i>Yogyakarta
                                </p>
                            </div>
                            <div class="col-md-4 my-2">
                                <h5 class="text-uppercase">Tanggal Pendaftaran</h5>
                                <p class="m-0"><i class="fa fa-calendar-alt text-primary me-2"></i>2 Desember 2024 - 20
                                    Desember 2024</p>
                            </div>
                            <div class="col-md-3 text-center my-2">
                                <a href="{{ route('careers.show', 'slug') }}" class="btn btn-primary py-3 px-5">
                                    <h5 class="text-white">View Detail</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="row">
                            <div class="col-md-5 my-2">
                                <h5 class="text-uppercase">IT Support</h5>
                                <p class="m-0">
                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>Magelang
                                    <i class="fa fa-circle fa-xs text-primary me-2"></i>Yogyakarta
                                </p>
                            </div>
                            <div class="col-md-4 my-2">
                                <h5 class="text-uppercase">Tanggal Pendaftaran</h5>
                                <p class="m-0"><i class="fa fa-calendar-alt text-primary me-2"></i>2 Desember 2024 - 20
                                    Desember 2024</p>
                            </div>
                            <div class="col-md-3 text-center my-2">
                                <a href="{{ route('careers.show', 'slug') }}" class="btn btn-primary py-3 px-5">
                                    <h5 class="text-white">View Detail</h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Career End -->
@endsection
