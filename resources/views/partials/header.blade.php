<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Top bar Start -->
<div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-4 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-map-marker-alt text-primary me-2"></small>
                <small>{{ $profile->address }}</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="far fa-clock text-primary me-2"></small>
                <small>
                    @foreach ($operationalHours as $operationalHour)
                        {{ ($loop->index >= 1 ? ', ' : '') .
                            ($operationalHour->day_from == $operationalHour->day_to
                                ? $operationalHour->day_from
                                : $operationalHour->day_from . ' - ' . $operationalHour->day_to) .
                            ': ' .
                            Carbon\Carbon::parse($operationalHour->open_time)->format('H:i') .
                            ' - ' .
                            Carbon\Carbon::parse($operationalHour->close_time)->format('H:i') }}
                    @endforeach
                </small>
            </div>
        </div>
        <div class="col-lg-5 px-4 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                @foreach($phoneFaxs as $phoneFax)
                    @if($phoneFax->type == \App\Enums\ContactTypeEnum::PHONE->value)
                        <small class="fa fa-phone-alt text-primary me-2"></small>
                    @else
                        <small class="fa fa-fax text-primary me-2"></small>
                    @endif
                    <small class="me-2">{{ $phoneFax->contact }}</small>
                @endforeach
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                @foreach($socMeds as $socMed)
                    <a class="btn btn-sm-square bg-white text-primary me-1" href="{{ $socMed->contact }}" target="_blank">
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
    </div>
</div>
<!-- Top bar End -->
