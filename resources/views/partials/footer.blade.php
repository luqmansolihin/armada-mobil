<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">ALAMAT</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $profile->address }}</p>
                @foreach($phoneFaxs as $phoneFax)
                    <p class="mb-2">
                        <i class="fa
                        @if($phoneFax->type == \App\Enums\ContactTypeEnum::PHONE->value)
                            fa-phone-alt
                        @else
                            fa-fax
                        @endif
                        me-3"></i>
                        {{ $phoneFax->contact }}
                    </p>
                @endforeach
                @foreach($emails as $email)
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $email->contact }}</p>
                @endforeach
                <div class="d-flex pt-2">
                    @foreach($socMeds as $socMed)
                        <a class="btn btn-outline-light btn-social" href="{{ $socMed->contact }}" target="_blank">
                            @if($socMed->type == \App\Enums\ContactTypeEnum::FACEBOOK->value)
                                <i class="fab fa-facebook-f"></i>
                            @elseif($socMed->type == \App\Enums\ContactTypeEnum::INSTAGRAM->value)
                                <i class="fab fa-instagram"></i>
                            @elseif($socMed->type == \App\Enums\ContactTypeEnum::TWITTER->value)
                                <i class="fab fa-twitter"></i>
                            @else
                                <i class="fab fa-youtube"></i>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">JAM BUKA</h4>
                @foreach ($operationalHours as $operationalHour)
                    <h6 class="text-light">
                        {{ $operationalHour->day_from == $operationalHour->day_to
                            ? $operationalHour->day_from
                            : $operationalHour->day_from . ' - ' . $operationalHour->day_to }}
                    </h6>
                    <p class="mb-4">
                        {{ Carbon\Carbon::parse($operationalHour->open_time)->format('H:i') . ' - ' . Carbon\Carbon::parse($operationalHour->close_time)->format('H:i') }}
                    </p>
                @endforeach
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">BROSUR</h4>
                @foreach ($brochures as $brochure)
                    <p class="mb-2">
                        <i class="fa fa-folder-open me-3">
                        </i><a class="text-decoration-none text-white"
                            href="{{ $brochure->url }}">{{ $brochure->title }}</a>
                    </p>
                @endforeach
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-light mb-4">TENTANG ARMADA</h4>
                <p>{{ $profile->short_description }}</p>
                <a href="{{ route('profile') }}" class="btn btn-primary py-3 px-5 mt-3">Read More<i
                        class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    Copyright &copy; 2024, All Right Reserved. <br>
                    Made with <span class="text-primary">&#10084;</span> by Armada Mobil
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
