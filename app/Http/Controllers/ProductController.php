<?php

namespace App\Http\Controllers;

use App\Models\Brochure;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->select(['slug', 'title', 'image'])
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        return view('pages.products.index', compact('products', 'profile', 'brochures'));
    }

    public function show(string $slug): View
    {
        $product = Product::query()
            ->select(['title', 'image', 'content'])
            ->where('status', 1)
            ->where('slug', $slug)
            ->firstOrFail();

        $profile = Profile::query()
            ->select(['address', 'short_description', 'cover'])
            ->first();

        $brochures = Brochure::query()
            ->select(['title', 'url'])
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        return view('pages.products.show', compact('product', 'profile', 'brochures'));
    }
}
