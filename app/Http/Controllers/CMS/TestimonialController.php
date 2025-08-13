<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\TestimonialStoreRequest;
use App\Http\Requests\CMS\TestimonialUpdateRequest;
use App\Models\Testimonial;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::query()
            ->select(['id', 'name', 'profession', 'status'])
            ->get();

        return view('pages.cms.testimonials.index', compact('testimonials'));
    }

    public function create(): View
    {
        return view('pages.cms.testimonials.create');
    }

    public function store(TestimonialStoreRequest $request): RedirectResponse
    {
        $destinationPath = public_path('img/testimonial');
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        $fullUrl = asset('img/testimonial/' . $filename);

        $request = $request->safe()->merge([
            'image' => $fullUrl
        ]);

        Testimonial::query()->create($request->all());

        return to_route('cms.testimonials.index')->with('success', 'Testimonial has been created.');
    }

    public function edit(int $id): View
    {
        $testimonial = Testimonial::query()->findOrFail($id);

        return view('pages.cms.testimonials.edit', compact('testimonial'));
    }

    public function update(int $id, TestimonialUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validatedRequest = $request->validated();

            $testimonial = Testimonial::query()->findOrFail($id);

            if ($request->hasFile('image')) {
                $destinationPath = public_path('img/testimonial');
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                if (!empty($testimonial->image)) {
                    $oldFileName = basename($testimonial->image);
                    $oldFilePath = $destinationPath . '/' . $oldFileName;

                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $file->move($destinationPath, $filename);

                $fullUrl = asset('img/testimonial/' . $filename);

                $validatedRequest['image'] = $fullUrl;
            }

            $testimonial->update($validatedRequest);

            DB::commit();

            return to_route('cms.testimonials.index')->with('success', 'Testimonial has been edited.');
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

            $testimonial = Testimonial::query()->findOrFail($id);

            $testimonial->update(['user_id' => auth()->user()->id]);

            $testimonial->delete();

            DB::commit();

            return to_route('cms.testimonials.index')->with('success', 'Testimonial has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
