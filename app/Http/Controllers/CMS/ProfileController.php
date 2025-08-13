<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(): View
    {
        $profile = Profile::query()->first();

        return view('pages.cms.profiles.index', compact('profile'));
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $profile = Profile::query()->first();

            $validatedRequest = $request->validated();

            if ($request->hasFile('cover')) {
                $destinationPath = public_path('img/profile');
                $file = $request->file('cover');
                $filename = time() . '.' . $file->getClientOriginalExtension();

                if (!empty($profile->cover)) {
                    $oldFileName = basename($profile->cover);
                    $oldFilePath = $destinationPath . '/' . $oldFileName;

                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }

                $file->move($destinationPath, $filename);

                $fullUrl = asset('img/profile/' . $filename);

                $validatedRequest['cover'] = $fullUrl;
            }

            $profile->update($validatedRequest);

            DB::commit();

            return to_route('cms.profiles.index')->with('success', 'Profile has been edited.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
