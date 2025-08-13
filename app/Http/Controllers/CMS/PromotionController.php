<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\PromotionStoreRequest;
use App\Http\Requests\CMS\PromotionUpdateRequest;
use App\Models\Promotion;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PromotionController extends Controller
{
    public function index(): View
    {
        $promotions = Promotion::query()
            ->select(['id', 'title', 'status', 'created_at'])
            ->orderByDesc('created_at')
            ->get();

        return view('pages.cms.promotions.index', compact('promotions'));
    }

    public function create(): View
    {
        return view('pages.cms.promotions.create');
    }

    public function store(PromotionStoreRequest $request): RedirectResponse
    {
        $destinationPath = public_path('img/promotion');
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        $fullUrl = asset('img/promotion/' . $filename);

        $request = $request->safe()->merge([
            'image' => $fullUrl
        ]);

        Promotion::query()->create($request->all());

        return to_route('cms.promotions.index')->with('success', 'Promotion has been created.');
    }

    public function edit(int $id): View
    {
        $promotion = Promotion::query()->findOrFail($id);

        return view('pages.cms.promotions.edit', compact('promotion'));
    }

    public function update(int $id, PromotionUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validatedRequest = $request->validated();

            $promotion = Promotion::query()->findOrFail($id);

            if ($request->hasFile('image')) {
                $destinationPath = public_path('img/promotion');
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                if (!empty($promotion->image)) {
                    $oldFileName = basename($promotion->image);
                    $oldFilePath = $destinationPath . '/' . $oldFileName;

                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $file->move($destinationPath, $filename);

                $fullUrl = asset('img/promotion/' . $filename);

                $validatedRequest['image'] = $fullUrl;
            }

            $promotion->update($validatedRequest);

            DB::commit();

            return to_route('cms.promotions.index')->with('success', 'Promotion has been edited.');
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

            $promotion = Promotion::query()->findOrFail($id);

            $promotion->update(['user_id' => auth()->user()->id]);

            $promotion->delete();

            DB::commit();

            return to_route('cms.promotions.index')->with('success', 'Promotion has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
