<?php

namespace App\Http\Controllers;

use App\Enums\ContactTypeEnum;
use App\Enums\DayEnum;
use App\Models\Brochure;
use App\Models\Contact;
use App\Models\OperationalHour;
use App\Models\Profile;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profile = Profile::query()
            ->select(['cover', 'address', 'short_description', 'description'])
            ->first();

        $services = Service::query()
            ->select(['title', 'icon', 'description'])
            ->orderBy('title')
            ->get();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        $testimonials = Testimonial::query()
            ->select(['name', 'profession', 'image', 'testimonial'])
            ->where('status', 1)
            ->get();

        $operationalHours = OperationalHour::query()
            ->select(['day_from', 'day_to', 'open_time', 'close_time'])
            ->orderByRaw("CASE
            WHEN day_from = '".DayEnum::Monday->value."' THEN 1
            WHEN day_from = '".DayEnum::Tuesday->value."' THEN 2
            WHEN day_from = '".DayEnum::Wednesday->value."' THEN 3
            WHEN day_from = '".DayEnum::Thursday->value."' THEN 4
            WHEN day_from = '".DayEnum::Friday->value."' THEN 5
            WHEN day_from = '".DayEnum::Saturday->value."' THEN 6
            WHEN day_from = '".DayEnum::Sunday->value."' THEN 7
            END")
            ->get();

        $phoneFaxs = Contact::query()
            ->where(function ($query) {
                $query->where('type', ContactTypeEnum::PHONE->value)
                    ->orWhere('type', ContactTypeEnum::FAX->value);
            })
            ->whereNot('type', ContactTypeEnum::EMAIL->value)
            ->orderByDesc('type')
            ->get();

        $socMeds = Contact::query()
            ->whereNot('type', ContactTypeEnum::PHONE->value)
            ->whereNot('type', ContactTypeEnum::FAX->value)
            ->whereNot('type', ContactTypeEnum::EMAIL->value)
            ->orderBy('type')
            ->get();

        $emails = Contact::query()
            ->where('type', ContactTypeEnum::EMAIL->value)
            ->orderBy('contact')
            ->get();

        return view('pages.profile', compact(
            'profile',
            'services',
            'brochures',
            'testimonials',
            'operationalHours',
            'phoneFaxs',
            'socMeds',
            'emails')
        );
    }
}
