<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\ListingType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ListingTypeStoreRequest;
use App\Http\Requests\ListingTypeUpdateRequest;

class ListingTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ListingType::class);

        $search = $request->get('search', '');

        $listingTypes = ListingType::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.listing_types.index',
            compact('listingTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ListingType::class);

        return view('app.listing_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingTypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ListingType::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $listingType = ListingType::create($validated);

        return redirect()
            ->route('listing-types.edit', $listingType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ListingType $listingType): View
    {
        $this->authorize('view', $listingType);

        return view('app.listing_types.show', compact('listingType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ListingType $listingType): View
    {
        $this->authorize('update', $listingType);

        return view('app.listing_types.edit', compact('listingType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ListingTypeUpdateRequest $request,
        ListingType $listingType
    ): RedirectResponse {
        $this->authorize('update', $listingType);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($listingType->image) {
                Storage::delete($listingType->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $listingType->update($validated);

        return redirect()
            ->route('listing-types.edit', $listingType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ListingType $listingType
    ): RedirectResponse {
        $this->authorize('delete', $listingType);

        if ($listingType->image) {
            Storage::delete($listingType->image);
        }

        $listingType->delete();

        return redirect()
            ->route('listing-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
