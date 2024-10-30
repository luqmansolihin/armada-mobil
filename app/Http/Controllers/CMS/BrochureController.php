<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrochureStoreRequest;
use App\Http\Requests\BrochureUpdateRequest;
use App\Models\Brochure;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class BrochureController extends Controller
{
    public function index(): View
    {
        $brochures = Brochure::query()
            ->select(['id', 'title', 'url', 'status'])
            ->get();

        return view('pages.cms.brochures.index', compact('brochures'));
    }

    public function create(): View
    {
        return view('pages.cms.brochures.create');
    }

    public function store(BrochureStoreRequest $request): RedirectResponse
    {
        Brochure::query()->create($request->validated());

        return to_route('cms.brochures.index')->with('success', 'Brochure has been created.');
    }

    public function edit(int $id): View
    {
        $brochure = Brochure::query()
            ->select(['id', 'title', 'url', 'status'])
            ->findOrFail($id);

        return view('pages.cms.brochures.edit', compact('brochure'));
    }

    public function update(int $id, BrochureUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $brochure = Brochure::query()->findOrFail($id);

            $brochure->update($request->validated());

            DB::commit();

            return to_route('cms.brochures.index')->with('success', 'Brochure has been edited.');
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

            $brochure = Brochure::query()->findOrFail($id);

            $brochure->update(['user_id' => auth()->user()->id]);

            $brochure->delete();

            DB::commit();

            return to_route('cms.brochures.index')->with('success', 'Brochure has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
