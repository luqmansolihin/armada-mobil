<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\BannerStoreRequest;
use App\Http\Requests\CMS\BannerUpdateRequest;
use App\Models\Banner;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $destinationPath = public_path('img/banner');
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        $fullUrl = asset('img/banner/' . $filename);

        $request = $request->safe()->merge([
            'image' => $fullUrl
        ]);

        Banner::query()->create($request->all());

        return to_route('cms.banners.index')->with('success', 'Banner has been created.');
    }

    public function edit(int $id): View
    {
        $banner = Banner::query()->findOrFail($id);

        return view('pages.cms.banners.edit', compact('banner'));
    }

    public function update(int $id, BannerUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $banner = Banner::query()->findOrFail($id);

            $validatedRequest = $request->validated();

            if ($request->hasFile('image')) {
                $destinationPath = public_path('img/banner');
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                if (!empty($banner->image)) {
                    $oldFileName = basename($banner->image);
                    $oldFilePath = $destinationPath . '/' . $oldFileName;

                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $file->move($destinationPath, $filename);

                $fullUrl = asset('img/banner/' . $filename);

                $validatedRequest['image'] = $fullUrl;
            }

            $banner->update($validatedRequest);

            DB::commit();

            return to_route('cms.banners.index')->with('success', 'Banner has been edited.');
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

            $banner = Banner::query()->findOrFail($id);

            $banner->update(['user_id' => auth()->user()->id]);

            $banner->delete();

            DB::commit();

            return to_route('cms.banners.index')->with('success', 'Banner has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
