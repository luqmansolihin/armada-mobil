<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profile = Profile::query()
            ->select(['cover', 'address', 'short_description', 'description'])
            ->first();

        return view('pages.profile', compact('profile'));
    }
}
