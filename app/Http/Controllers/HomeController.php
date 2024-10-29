<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::query()
            ->select(['title', 'image'])
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
            ->limit(6)
            ->get();

        return view('pages.home', compact('banners', 'profile', 'blogs', 'products'));
    }
}
