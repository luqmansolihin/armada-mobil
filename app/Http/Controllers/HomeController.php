<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $banners = Banner::query()
            ->select(['title', 'image'])
            ->where('status', 1)
            ->get();

        return view('pages.home', compact('banners'));
    }
}
