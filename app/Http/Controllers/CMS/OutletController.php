<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Service;
use Illuminate\View\View;

class OutletController extends Controller
{
    public function index(): View
    {
        $outlets = Outlet::query()
            ->select(['id', 'name'])
            ->get();

        return view('pages.cms.outlets.index', compact('outlets'));
    }

    public function create(): View
    {
        $services = Service::query()
            ->orderBy('title')
            ->get();

        return view('pages.cms.outlets.create', compact('services'));
    }

    public function store(OperationalHourStoreRequest $request): RedirectResponse
    {
        OperationalHour::query()->create($request->validated());

        return to_route('cms.operational-hours.index')->with('success', 'Operational hour has been created.');
    }

    public function edit(int $id): View
    {
        $operationalHour = OperationalHour::query()
            ->select(['id', 'day_from', 'day_to', 'open_time', 'close_time'])
            ->findOrFail($id);

        return view('pages.cms.operational-hours.edit', compact('operationalHour'));
    }

    public function update(int $id, OperationalHourUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $operationalHour = OperationalHour::query()->findOrFail($id);

            $operationalHour->update($request->validated());

            DB::commit();

            return to_route('cms.operational-hours.index')->with('success', 'Operational hour has been edited.');
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
