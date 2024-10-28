<?php

namespace App\Http\Controllers;

use App\Models\Banner;
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

        return view('pages.home', compact('banners', 'profile'));
    }
}
