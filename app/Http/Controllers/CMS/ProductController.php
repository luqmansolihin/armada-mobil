<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\ProductStoreRequest;
use App\Http\Requests\CMS\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::query()
            ->with('productBrand')
            ->select(['id', 'title', 'status', 'product_brand_id'])
            ->get();

        return view('pages.cms.products.index', compact('products'));
    }

    public function create(): View
    {
        $productBrands = ProductBrand::query()
            ->where('name', 'isuzu')
            ->get();

        return view('pages.cms.products.create', compact('productBrands'));
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $image = $request->file('image');
        $mime = $image->getClientMimeType();
        $base64 = base64_encode(file_get_contents($image->getRealPath()));

        $request = $request->safe()->merge([
            'image' => "data:{$mime};base64,{$base64}"
        ]);

        Product::query()->create($request->all());

        return to_route('cms.products.index')->with('success', 'Product has been created.');
    }

    public function edit(int $id): View
    {
        $productBrands = ProductBrand::query()
            ->where('name', 'isuzu')
            ->get();

        $product = Product::query()
            ->select(['id', 'title', 'product_brand_id', 'image', 'content', 'status'])
            ->findOrFail($id);

        return view('pages.cms.products.edit', compact('productBrands', 'product'));
    }

    public function update(int $id, ProductUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validatedRequest = $request->validated();

            $product = Product::query()->findOrFail($id);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $mime = $image->getClientMimeType();
                $base64 = base64_encode(file_get_contents($image->getRealPath()));

                $validatedRequest['image'] = "data:{$mime};base64,{$base64}";
            }

            $product->update($validatedRequest);

            DB::commit();

            return to_route('cms.products.index')->with('success', 'Product has been edited.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $product = Product::query()->findOrFail($id);

            $product->update(['user_id' => auth()->user()->id]);

            $product->delete();

            DB::commit();

            return to_route('cms.products.index')->with('success', 'Product has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
