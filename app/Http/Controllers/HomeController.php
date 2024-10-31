<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Brochure;
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

        return view('pages.home', compact('banners', 'profile', 'blogs', 'products', 'brochures', 'testimonials'));
    }
}
