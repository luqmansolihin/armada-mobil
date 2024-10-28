<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\BannerStoreRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    public function index(): View
    {
        $banners = Banner::query()
            ->select(['id', 'title', 'status'])
            ->get();

        return view('pages.cms.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('pages.cms.banners.create');
    }

    public function store(BannerStoreRequest $request): RedirectResponse
    {
        dd($request->validated());
    }
}
