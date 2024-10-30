<?php

namespace App\Http\Controllers;

use App\Models\Brochure;
use App\Models\Profile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profile = Profile::query()
            ->select(['cover', 'address', 'short_description', 'description'])
            ->first();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        return view('pages.profile', compact('profile', 'brochures'));
    }
}
