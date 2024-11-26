<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\CareerStoreRequest;
use App\Http\Requests\CMS\CareerUpdateRequest;
use App\Models\Career;
use App\Models\CareerPlacement;
use App\Models\City;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $careers = Career::query()
            ->select(['id', 'name', 'registration_from', 'registration_to', 'status'])
            ->orderByDesc('registration_from')
            ->get();

        return view('pages.cms.careers.index', compact('careers'));
    }

    public function create(): View
    {
        $cities = City::query()
            ->orderBy('name')
            ->get();

        return view('pages.cms.careers.create', compact('cities'));
    }

    public function store(CareerStoreRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $requestCareer = $request->safe()->except(['careers']);

            $career = Career::query()->create($requestCareer);

            $requestPlacements = $request->validated('careers');

            foreach ($requestPlacements as $requestPlacement) {
                $career->careerPlacements()->create(['city_id' => $requestPlacement['placement']]);
            }

            DB::commit();

            return to_route('cms.careers.index')->with('success', 'Career has been created.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }

    public function edit(int $id): View
    {
        $career = Career::query()
            ->with(['careerPlacements'])
            ->findOrFail($id);

        $cities = City::query()
            ->orderBy('name')
            ->get();

        return view('pages.cms.careers.edit', compact('career', 'cities'));
    }

    public function update(int $id, CareerUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $career = Career::query()->findOrFail($id);

            $careerPlacements = CareerPlacement::query()
                ->where('career_id', $career->id)
                ->delete();

            $requestCareer = $request->safe()->except(['careers']);

            $career->update($requestCareer);

            $requestPlacements = $request->validated('careers');

            foreach ($requestPlacements as $requestPlacement) {
                $career->careerPlacements()->create(['city_id' => $requestPlacement['placement']]);
            }

            DB::commit();

            return to_route('cms.careers.index')->with('success', 'Career has been edited.');
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

            $career = Career::query()->findOrFail($id);

            $career->update(['user_id' => auth()->user()->id]);

            $career->delete();

            DB::commit();

            return to_route('cms.careers.index')->with('success', 'Career has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
