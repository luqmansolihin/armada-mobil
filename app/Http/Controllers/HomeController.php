<?php

namespace App\Http\Controllers;

use App\Enums\ContactTypeEnum;
use App\Enums\DayEnum;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brochure;
use App\Models\Contact;
use App\Models\OperationalHour;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::query()
            ->select(['title', 'image'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        $blogs = Blog::query()
            ->select(['user_id', 'slug', 'title', 'image', 'content', 'created_at'])
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->limit(6)
            ->get();

        $products = Product::query()
            ->select(['slug', 'title', 'image'])
            ->where('status', 1)
            ->orderByDesc('id')
            ->limit(6)
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

        return view('pages.home', compact(
            'banners',
            'profile',
            'blogs',
            'products',
            'brochures',
            'testimonials',
            'operationalHours',
            'phoneFaxs',
            'socMeds',
            'emails')
        );
    }
}
