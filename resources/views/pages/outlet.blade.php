@extends('layouts.app')

@section('content')
    <!-- Cover Start-->
    <div class="container-fluid page-header mb-5 p-0" style="background-image: url('{{ $profile->cover }}');">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center py-5">
                <h1 class="display-3 text-white mb-3 animated slideInDown">OUTLETS</h1>
            </div>
        </div>
    </div>
    <!-- Cover End-->

    <!-- Service Start -->
    <div class="container-xxl service py-5">
        <div class="container">
            <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-4">
                    <div class="nav w-100 nav-pills me-4">
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active"
                            data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                            <i class="fa fa-map-marker-alt fa-2x me-3"></i>
                            <h4 class="m-0">ARMADA ISUZU MAGELANG</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill"
                            data-bs-target="#tab-pane-2" type="button">
                            <i class="fa fa-map-marker-alt fa-2x me-3"></i>
                            <h4 class="m-0">ARMADA ISUZU JOGJA</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill"
                            data-bs-target="#tab-pane-3" type="button">
                            <i class="fa fa-map-marker-alt fa-2x me-3"></i>
                            <h4 class="m-0">ARMADA ISUZU PURWOKERTO</h4>
                        </button>
                        <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill"
                            data-bs-target="#tab-pane-4" type="button">
                            <i class="fa fa-map-marker-alt fa-2x me-3"></i>
                            <h4 class="m-0">ARMADA ISUZU CILACAP</h4>
                        </button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content w-100">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <h3 class="mb-2"><i class="fa fa-map text-primary me-3"></i>Address</h3>
                                    <p class="mb-2">39679 Rylan Parkway Suite 114 Kobemouth, ND 76290-6595</p>
                                    <h3 class="mb-2"><i class="fa fa-phone text-primary me-3"></i>Phone</h3>
                                    <p class="mb-2">(0293) 365211</p>
                                    <h3 class="mb-2"><i class="fa fa-fax text-primary me-3"></i>Fax</h3>
                                    <p class="mb-2">(0293) 365210</p>
                                    <h3 class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>Email</h3>
                                    <p class="mb-2">aimpusat88@gmail.com</p>
                                    <h3 class="mb-2"><i class="fa fa-clock text-primary me-3"></i>Operational Hours</h3>
                                    <p class="mb-2">Senin-Jumat : 08.00 - 16.30</p>
                                    <p class="mb-2">Sabtu : 08.00 - 12.00</p>
                                    <h3 class="mb-2"><i class="fa fa-hand-holding-heart text-primary me-3"></i>Our
                                        Services</h3>
                                    <p class="mb-2">
                                        <i class="fa fa-chart-line text-primary me-3"></i>Penjualan
                                        <i class="fa fa-truck text-primary ms-3 me-3"></i>Service
                                        <i class="fa fa-cogs text-primary ms-3 me-3"></i>Spare Part
                                    </p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">View Map<i
                                            class="fa fa-location-arrow ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <h3 class="mb-2"><i class="fa fa-map text-primary me-3"></i>Address</h3>
                                    <p class="mb-2">39679 Rylan Parkway Suite 114 Kobemouth, ND 76290-6595</p>
                                    <h3 class="mb-2"><i class="fa fa-phone text-primary me-3"></i>Phone</h3>
                                    <p class="mb-2">(0293) 365211</p>
                                    <h3 class="mb-2"><i class="fa fa-fax text-primary me-3"></i>Fax</h3>
                                    <p class="mb-2">(0293) 365210</p>
                                    <h3 class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>Email</h3>
                                    <p class="mb-2">aimpusat88@gmail.com</p>
                                    <h3 class="mb-2"><i class="fa fa-clock text-primary me-3"></i>Operational Hours</h3>
                                    <p class="mb-2">Senin-Jumat : 08.00 - 16.30</p>
                                    <p class="mb-2">Sabtu : 08.00 - 12.00</p>
                                    <h3 class="mb-2"><i class="fa fa-hand-holding-heart text-primary me-3"></i>Our
                                        Services</h3>
                                    <p class="mb-2">
                                        <i class="fa fa-chart-line text-primary me-3"></i>Penjualan
                                        <i class="fa fa-truck text-primary ms-3 me-3"></i>Service
                                        <i class="fa fa-cogs text-primary ms-3 me-3"></i>Spare Part
                                    </p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">View Map<i
                                            class="fa fa-location-arrow ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <h3 class="mb-2"><i class="fa fa-map text-primary me-3"></i>Address</h3>
                                    <p class="mb-2">39679 Rylan Parkway Suite 114 Kobemouth, ND 76290-6595</p>
                                    <h3 class="mb-2"><i class="fa fa-phone text-primary me-3"></i>Phone</h3>
                                    <p class="mb-2">(0293) 365211</p>
                                    <h3 class="mb-2"><i class="fa fa-fax text-primary me-3"></i>Fax</h3>
                                    <p class="mb-2">(0293) 365210</p>
                                    <h3 class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>Email</h3>
                                    <p class="mb-2">aimpusat88@gmail.com</p>
                                    <h3 class="mb-2"><i class="fa fa-clock text-primary me-3"></i>Operational Hours</h3>
                                    <p class="mb-2">Senin-Jumat : 08.00 - 16.30</p>
                                    <p class="mb-2">Sabtu : 08.00 - 12.00</p>
                                    <h3 class="mb-2"><i class="fa fa-hand-holding-heart text-primary me-3"></i>Our
                                        Services</h3>
                                    <p class="mb-2">
                                        <i class="fa fa-chart-line text-primary me-3"></i>Penjualan
                                        <i class="fa fa-truck text-primary ms-3 me-3"></i>Service
                                        <i class="fa fa-cogs text-primary ms-3 me-3"></i>Spare Part
                                    </p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">View Map<i
                                            class="fa fa-location-arrow ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-4">
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <h3 class="mb-2"><i class="fa fa-map text-primary me-3"></i>Address</h3>
                                    <p class="mb-2">39679 Rylan Parkway Suite 114 Kobemouth, ND 76290-6595</p>
                                    <h3 class="mb-2"><i class="fa fa-phone text-primary me-3"></i>Phone</h3>
                                    <p class="mb-2">(0293) 365211</p>
                                    <h3 class="mb-2"><i class="fa fa-fax text-primary me-3"></i>Fax</h3>
                                    <p class="mb-2">(0293) 365210</p>
                                    <h3 class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>Email</h3>
                                    <p class="mb-2">aimpusat88@gmail.com</p>
                                    <h3 class="mb-2"><i class="fa fa-clock text-primary me-3"></i>Operational Hours</h3>
                                    <p class="mb-2">Senin-Jumat : 08.00 - 16.30</p>
                                    <p class="mb-2">Sabtu : 08.00 - 12.00</p>
                                    <h3 class="mb-2"><i class="fa fa-hand-holding-heart text-primary me-3"></i>Our
                                        Services</h3>
                                    <p class="mb-2">
                                        <i class="fa fa-chart-line text-primary me-3"></i>Penjualan
                                        <i class="fa fa-truck text-primary ms-3 me-3"></i>Service
                                        <i class="fa fa-cogs text-primary ms-3 me-3"></i>Spare Part
                                    </p>
                                    <a href="" class="btn btn-primary py-3 px-5 mt-3">View Map<i
                                            class="fa fa-location-arrow ms-3"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
