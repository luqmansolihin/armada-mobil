<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\AfterSaleStoreRequest;
use App\Http\Requests\CMS\AfterSaleUpdateRequest;
use App\Models\AfterSale;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AfterSaleController extends Controller
{
    public function index(): View
    {
        $afterSales = AfterSale::query()
            ->select(['id', 'title', 'status', 'created_at'])
            ->orderByDesc('created_at')
            ->get();

        return view('pages.cms.after-sales.index', compact('afterSales'));
    }

    public function create(): View
    {
        return view('pages.cms.after-sales.create');
    }

    public function store(AfterSaleStoreRequest $request): RedirectResponse
    {
        $image = $request->file('image');
        $mime = $image->getClientMimeType();
        $base64 = base64_encode(file_get_contents($image->getRealPath()));

        $request = $request->safe()->merge([
            'image' => "data:{$mime};base64,{$base64}"
        ]);

        AfterSale::query()->create($request->all());

        return to_route('cms.after-sales.index')->with('success', 'Service after sale has been created.');
    }

    public function edit(int $id): View
    {
        $afterSale = AfterSale::query()->findOrFail($id);

        return view('pages.cms.after-sales.edit', compact('afterSale'));
    }

    public function update(int $id, AfterSaleUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validatedRequest = $request->validated();

            $afterSale = AfterSale::query()->findOrFail($id);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $mime = $image->getClientMimeType();
                $base64 = base64_encode(file_get_contents($image->getRealPath()));

                $validatedRequest['image'] = "data:{$mime};base64,{$base64}";
            }

            $afterSale->update($validatedRequest);

            DB::commit();

            return to_route('cms.after-sales.index')->with('success', 'Service after sale has been edited.');
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

            $afterSale = AfterSale::query()->findOrFail($id);

            $afterSale->update(['user_id' => auth()->user()->id]);

            $afterSale->delete();

            DB::commit();

            return to_route('cms.after-sales.index')->with('success', 'Service after sale has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
