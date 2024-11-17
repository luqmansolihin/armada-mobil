<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\ContactStoreRequest;
use App\Http\Requests\CMS\ContactUpdateRequest;
use App\Models\Contact;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::query()
            ->select(['id', 'type', 'contact'])
            ->get();

        return view('pages.cms.contacts.index', compact('contacts'));
    }

    public function create(): View
    {
        return view('pages.cms.contacts.create');
    }

    public function store(ContactStoreRequest $request): RedirectResponse
    {
        Contact::query()->create($request->validated());

        return to_route('cms.contacts.index')->with('success', 'Contact has been created.');
    }

    public function edit(int $id): View
    {
        $contact = Contact::query()
            ->select(['id', 'type', 'contact'])
            ->findOrFail($id);

        return view('pages.cms.contacts.edit', compact('contact'));
    }

    public function update(int $id, ContactUpdateRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $contact = Contact::query()->findOrFail($id);

            $contact->update($request->validated());

            DB::commit();

            return to_route('cms.contacts.index')->with('success', 'Contact has been edited.');
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

            $contact = Contact::query()->findOrFail($id);

            $contact->update(['user_id' => auth()->user()->id]);

            $contact->delete();

            DB::commit();

            return to_route('cms.contacts.index')->with('success', 'Contact has been deleted.');
        } catch (QueryException $queryException) {
            Log::error($queryException->getTraceAsString());

            DB::rollBack();

            throw $queryException;
        }
    }
}
