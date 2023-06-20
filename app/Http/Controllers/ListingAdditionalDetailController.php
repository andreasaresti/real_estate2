<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\ListingAdditionalDetail;
use App\Http\Requests\ListingAdditionalDetailStoreRequest;
use App\Http\Requests\ListingAdditionalDetailUpdateRequest;

class ListingAdditionalDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ListingAdditionalDetail::class);

        $search = $request->get('search', '');

        $listingAdditionalDetails = ListingAdditionalDetail::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.listing_additional_details.index',
            compact('listingAdditionalDetails', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ListingAdditionalDetail::class);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.listing_additional_details.create',
            compact('listings')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ListingAdditionalDetailStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ListingAdditionalDetail::class);

        $validated = $request->validated();
        $validated['title'] = json_decode($validated['title'], true);

        $validated['value'] = json_decode($validated['value'], true);

        $listingAdditionalDetail = ListingAdditionalDetail::create($validated);

        return redirect()
            ->route('listing-additional-details.edit', $listingAdditionalDetail)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ListingAdditionalDetail $listingAdditionalDetail
    ): View {
        $this->authorize('view', $listingAdditionalDetail);

        return view(
            'app.listing_additional_details.show',
            compact('listingAdditionalDetail')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ListingAdditionalDetail $listingAdditionalDetail
    ): View {
        $this->authorize('update', $listingAdditionalDetail);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.listing_additional_details.edit',
            compact('listingAdditionalDetail', 'listings')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ListingAdditionalDetailUpdateRequest $request,
        ListingAdditionalDetail $listingAdditionalDetail
    ): RedirectResponse {
        $this->authorize('update', $listingAdditionalDetail);

        $validated = $request->validated();
        $validated['title'] = json_decode($validated['title'], true);

        $validated['value'] = json_decode($validated['value'], true);

        $listingAdditionalDetail->update($validated);

        return redirect()
            ->route('listing-additional-details.edit', $listingAdditionalDetail)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ListingAdditionalDetail $listingAdditionalDetail
    ): RedirectResponse {
        $this->authorize('delete', $listingAdditionalDetail);

        $listingAdditionalDetail->delete();

        return redirect()
            ->route('listing-additional-details.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
