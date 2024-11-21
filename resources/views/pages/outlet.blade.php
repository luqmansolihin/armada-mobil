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
                                            src="{{ $outlet->url_embed_address }}" frameborder="0" allowfullscreen=""
                                            aria-hidden="false" tabindex="0"></iframe>
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
                                        <h3 class="mb-2"><i class="fa fa-clock text-primary me-3"></i>Operational Hours
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
                                        <h3 class="mb-2"><i class="fa fa-hand-holding-heart text-primary me-3"></i>Our
                                            Services</h3>
                                        <p class="mb-2">
                                            @foreach ($outlet->outletHasServices as $outletHasService)
                                                <i
                                                    class="{{ $outletHasService->service->icon }} text-primary @if ($loop->index > 0) ms-3 @endif me-3"></i>{{ $outletHasService->service->title }}
                                            @endforeach
                                        </p>
                                        <a href="{{ $outlet->url_address }}" class="btn btn-primary py-3 px-5 mt-3"
                                            target="_blank">View Larger Map<i class="fa fa-location-arrow ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection
