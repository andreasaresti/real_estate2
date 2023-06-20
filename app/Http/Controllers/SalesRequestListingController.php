<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SalesRequestListing;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesRequestListingStoreRequest;
use App\Http\Requests\SalesRequestListingUpdateRequest;

class SalesRequestListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesRequestListing::class);

        $search = $request->get('search', '');

        $salesRequestListings = SalesRequestListing::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_request_listings.index',
            compact('salesRequestListings', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesRequestListing::class);

        $listings = Listing::pluck('name', 'id');

        return view('app.sales_request_listings.create', compact('listings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SalesRequestListingStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SalesRequestListing::class);

        $validated = $request->validated();

        $salesRequestListing = SalesRequestListing::create($validated);

        return redirect()
            ->route('sales-request-listings.edit', $salesRequestListing)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SalesRequestListing $salesRequestListing
    ): View {
        $this->authorize('view', $salesRequestListing);

        return view(
            'app.sales_request_listings.show',
            compact('salesRequestListing')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SalesRequestListing $salesRequestListing
    ): View {
        $this->authorize('update', $salesRequestListing);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.sales_request_listings.edit',
            compact('salesRequestListing', 'listings')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesRequestListingUpdateRequest $request,
        SalesRequestListing $salesRequestListing
    ): RedirectResponse {
        $this->authorize('update', $salesRequestListing);

        $validated = $request->validated();

        $salesRequestListing->update($validated);

        return redirect()
            ->route('sales-request-listings.edit', $salesRequestListing)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesRequestListing $salesRequestListing
    ): RedirectResponse {
        $this->authorize('delete', $salesRequestListing);

        $salesRequestListing->delete();

        return redirect()
            ->route('sales-request-listings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
