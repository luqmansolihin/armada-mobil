<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\OperationalHourStoreRequest;
use App\Http\Requests\CMS\OperationalHourUpdateRequest;
use App\Models\OperationalHour;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class OperationalHourController extends Controller
{
    public function index(): View
    {
        $operationalHours = OperationalHour::query()
            ->select(['id', 'day_from', 'day_to', 'open_time', 'close_time'])
            ->get();

        return view('pages.cms.operational-hours.index', compact('operationalHours'));
    }

    public function create(): View
    {
        return view('pages.cms.operational-hours.create');
    }

    public function store(OperationalHourStoreRequest $request): RedirectResponse
    {
        OperationalHour::query()->create($request->validated());

        return to_route('cms.operational-hours.index')->with('success', 'Operational hour has been created.');
    }

    public function edit(int $id): View
    {
        $brochure = OperationalHour::query()
            ->select(['id', 'title', 'url', 'status'])
            ->findOrFail($id);

        return view('pages.cms.brochures.edit', compact('brochure'));
    }

    public function update(int $id, OperationalHourUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $brochure = OperationalHour::query()->findOrFail($id);

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

            $operationalHour = OperationalHour::query()->findOrFail($id);

            $operationalHour->update(['user_id' => auth()->user()->id]);

            $operationalHour->delete();

            DB::commit();

            return to_route('cms.operational-hours.index')->with('success', 'Operational hour has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
