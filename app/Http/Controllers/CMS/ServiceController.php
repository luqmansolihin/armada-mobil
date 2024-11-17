<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\ServiceStoreRequest;
use App\Http\Requests\CMS\ServiceUpdateRequest;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::query()
            ->select(['id', 'title', 'icon'])
            ->get();

        return view('pages.cms.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('pages.cms.services.create');
    }

    public function store(ServiceStoreRequest $request): RedirectResponse
    {
        Service::query()->create($request->validated());

        return to_route('cms.services.index')->with('success', 'Service has been created.');
    }

    public function edit(int $id): View
    {
        $service = Service::query()->findOrFail($id);

        return view('pages.cms.services.edit', compact('service'));
    }

    public function update(int $id, ServiceUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $service = Service::query()->findOrFail($id);

            $service->update($request->validated());

            DB::commit();

            return to_route('cms.services.index')->with('success', 'Service has been edited.');
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

            $service = Service::query()->findOrFail($id);

            $service->update(['user_id' => auth()->user()->id]);

            $service->delete();

            DB::commit();

            return to_route('cms.services.index')->with('success', 'Service has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
