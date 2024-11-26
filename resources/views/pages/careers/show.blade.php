@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $profile->cover }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white text-support mb-3 animated slideInDown">{{ strtoupper($career->name) }}</h1>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h3 class="text-uppercase">Tentang Pekerjaan</h3>
                                <hr>
                                {!! $career->description !!}
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h3 class="text-uppercase">Persyaratan</h3>
                                <hr>
                                {!! $career->requirement !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h5 class="text-uppercase">Tanggal Pendaftaran</h5>
                                <hr>
                                <p class="m-0">
                                    <i class="fa fa-calendar-alt text-primary me-2"></i>
                                    {{ Carbon\Carbon::parse($career->registration_from)->format('d F Y') . ' - ' . Carbon\Carbon::parse($career->registration_to)->format('d F Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h5 class="text-uppercase">Batas Usia</h5>
                                <hr>
                                <p class="m-0">
                                    <i class="fa fa-hourglass-half text-primary me-2"></i>
                                    {{ $career->minimal_age . ' - ' . $career->maximal_age . ' Tahun' }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12 my-2">
                            <div class="bg-light d-flex flex-column justify-content-center p-4 wow fadeInUp"
                                data-wow-delay="0.1s">
                                <h5 class="text-uppercase">Lokasi Penempatan</h5>
                                <hr>
                                <p class="m-0">
                                    @foreach ($career->careerPlacements as $careerPlacement)
                                        <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                        {{ ucwords(strtolower($careerPlacement->city->name)) }}
                                        <br>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
