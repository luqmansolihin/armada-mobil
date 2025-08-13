<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\BlogStoreRequest;
use App\Http\Requests\CMS\BlogUpdateRequest;
use App\Models\Blog;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->select(['id', 'title', 'status', 'created_at'])
            ->orderByDesc('created_at')
            ->get();

        return view('pages.cms.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('pages.cms.blogs.create');
    }

    public function store(BlogStoreRequest $request): RedirectResponse
    {
        $destinationPath = public_path('img/blog');
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $filename);

        $fullUrl = asset('img/blog/' . $filename);

        $request = $request->safe()->merge([
            'image' => $fullUrl
        ]);

        Blog::query()->create($request->all());

        return to_route('cms.blogs.index')->with('success', 'Blog has been created.');
    }

    public function edit(int $id): View
    {
        $blog = Blog::query()->findOrFail($id);

        return view('pages.cms.blogs.edit', compact('blog'));
    }

    public function update(int $id, BlogUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $validatedRequest = $request->validated();

            $blog = Blog::query()->findOrFail($id);

            if ($request->hasFile('image')) {
                $destinationPath = public_path('img/blog');
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                if (!empty($blog->image)) {
                    $oldFileName = basename($blog->image);
                    $oldFilePath = $destinationPath . '/' . $oldFileName;

                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $file->move($destinationPath, $filename);

                $fullUrl = asset('img/blog/' . $filename);

                $validatedRequest['image'] = $fullUrl;
            }

            $blog->update($validatedRequest);

            DB::commit();

            return to_route('cms.blogs.index')->with('success', 'Blog has been edited.');
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

            $blog = Blog::query()->findOrFail($id);

            $blog->update(['user_id' => auth()->user()->id]);

            $blog->delete();

            DB::commit();

            return to_route('cms.blogs.index')->with('success', 'Blog has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
