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
            ->get();

        return view('pages.cms.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('pages.cms.blogs.create');
    }

    public function store(BlogStoreRequest $request): RedirectResponse
    {
        $image = $request->file('image');
        $mime = $image->getClientMimeType();
        $base64 = base64_encode(file_get_contents($image->getRealPath()));

        $request = $request->safe()->merge([
            'image' => "data:{$mime};base64,{$base64}"
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
                $image = $request->file('image');
                $mime = $image->getClientMimeType();
                $base64 = base64_encode(file_get_contents($image->getRealPath()));

                $validatedRequest['image'] = "data:{$mime};base64,{$base64}";
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

            $block = Blog::query()->findOrFail($id);

            $block->update(['user_id' => auth()->user()->id]);

            $block->delete();

            DB::commit();

            return to_route('cms.blogs.index')->with('success', 'Blog has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
