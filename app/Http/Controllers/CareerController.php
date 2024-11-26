<?php

namespace App\Http\Controllers;

use App\Enums\ContactTypeEnum;
use App\Enums\DayEnum;
use App\Models\Brochure;
use App\Models\Career;
use App\Models\Contact;
use App\Models\OperationalHour;
use App\Models\Profile;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::query()
            ->with(['careerPlacements', 'careerPlacements.city'])
            ->where('status', 1)
            ->orderByDesc('registration_from')
            ->get();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
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

        return view('pages.careers.index', compact(
            'careers',
            'profile',
            'brochures',
            'operationalHours',
            'phoneFaxs',
            'socMeds',
            'emails')
        );
    }

    public function show(string $slug): View
    {
        $career = Career::query()
            ->with(['careerPlacements', 'careerPlacements.city'])
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
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

        return view('pages.careers.show', compact(
            'career',
            'profile',
            'brochures',
            'operationalHours',
            'phoneFaxs',
            'socMeds',
            'emails')
        );
    }
}
