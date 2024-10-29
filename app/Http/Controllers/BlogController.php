<?php

namespace App\Http\Controllers;

use App\Models\Blog;
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

        return view('pages.blogs.index', compact('blogs', 'profile'));
    }

    public function show(string $slug): View
    {
        $blog = Blog::query()
            ->select(['user_id', 'slug', 'title', 'image', 'content', 'created_at'])
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        return view('pages.blogs.show', compact('blog', 'profile'));
    }
}
