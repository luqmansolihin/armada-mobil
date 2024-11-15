<?php

namespace App\Http\Controllers;

use App\Enums\DayEnum;
use App\Models\Blog;
use App\Models\Brochure;
use App\Models\OperationalHour;
use App\Models\Profile;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->select(['slug', 'title', 'image', 'created_at'])
            ->where('status', 1)
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

        return view('pages.blogs.index', compact('blogs', 'profile', 'brochures', 'operationalHours'));
    }

    public function show(string $slug): View
    {
        $blog = Blog::query()
            ->select(['user_id', 'slug', 'title', 'image', 'content', 'created_at'])
            ->where('status', 1)
            ->where('slug', $slug)
            ->orderByDesc('id')
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

        return view('pages.blogs.show', compact('blog', 'profile', 'brochures', 'operationalHours'));
    }
}
