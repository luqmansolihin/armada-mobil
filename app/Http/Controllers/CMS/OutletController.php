<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\OutletStoreRequest;
use App\Http\Requests\CMS\OutletUpdateRequest;
use App\Models\Outlet;
use App\Models\OutletHasOperationalHour;
use App\Models\OutletHasService;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function store(OutletStoreRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $requestOutlet = $request->safe()->only(['user_id', 'name', 'address', 'phone', 'fax', 'email', 'url_address', 'url_embed_address']);

            $outlet = Outlet::query()->create($requestOutlet);

            $requestServices = $request->validated('service_id');

            foreach ($requestServices as $requestService) {
                $outlet->outletHasServices()->create(['service_id' => $requestService]);
            }

            $requestOperationalHours = $request->validated('outlets');

            foreach ($requestOperationalHours as $requestOperationalHour) {
                $outlet->outletHasOperationalHours()->create($requestOperationalHour);
            }

            DB::commit();

            return to_route('cms.outlets.index')->with('success', 'Outlet has been created.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }

    public function edit(int $id): View
    {
        $outlet = Outlet::query()
            ->with(['outletHasServices', 'outletHasOperationalHours'])
            ->findOrFail($id);

        $services = Service::query()
            ->orderBy('title')
            ->get();

        return view('pages.cms.outlets.edit', compact('outlet', 'services'));
    }

    public function update(int $id, OutletUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $outlet = Outlet::query()->findOrFail($id);

            $outletHasOperationalHours = OutletHasOperationalHour::query()
                ->where('outlet_id', $outlet->id)
                ->delete();

            $outletHasServices = OutletHasService::query()
                ->where('outlet_id', $outlet->id)
                ->delete();

            $requestOutlet = $request->safe()->only(['user_id', 'name', 'address', 'phone', 'fax', 'email', 'url_address', 'url_embed_address']);

            $outlet->update($requestOutlet);

            $requestServices = $request->validated('service_id');

            foreach ($requestServices as $requestService) {
                $outlet->outletHasServices()->create(['service_id' => $requestService]);
            }

            $requestOperationalHours = $request->validated('outlets');

            foreach ($requestOperationalHours as $requestOperationalHour) {
                $outlet->outletHasOperationalHours()->create($requestOperationalHour);
            }

            DB::commit();

            return to_route('cms.outlets.index')->with('success', 'Outlet has been edited.');
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

            $outlet = Outlet::query()->findOrFail($id);

            $outlet->update(['user_id' => auth()->user()->id]);

            $outlet->delete();

            DB::commit();

            return to_route('cms.outlets.index')->with('success', 'Outlet has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
