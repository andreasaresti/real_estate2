<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Models\ListingRequest;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ListingRequestStoreRequest;
use App\Http\Requests\ListingRequestUpdateRequest;

class ListingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ListingRequest::class);

        $search = $request->get('search', '');

        $listingRequests = ListingRequest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.listing_requests.index',
            compact('listingRequests', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ListingRequest::class);

        $customers = Customer::pluck('name', 'id');
        $sources = Source::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');

        return view(
            'app.listing_requests.create',
            compact('customers', 'sources', 'allSalesPeople')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingRequestStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ListingRequest::class);

        $validated = $request->validated();

        $listingRequest = ListingRequest::create($validated);

        return redirect()
            ->route('listing-requests.edit', $listingRequest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ListingRequest $listingRequest): View
    {
        $this->authorize('view', $listingRequest);

        return view('app.listing_requests.show', compact('listingRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ListingRequest $listingRequest): View
    {
        $this->authorize('update', $listingRequest);

        $customers = Customer::pluck('name', 'id');
        $sources = Source::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');

        return view(
            'app.listing_requests.edit',
            compact('listingRequest', 'customers', 'sources', 'allSalesPeople')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ListingRequestUpdateRequest $request,
        ListingRequest $listingRequest
    ): RedirectResponse {
        $this->authorize('update', $listingRequest);

        $validated = $request->validated();

        $listingRequest->update($validated);

        return redirect()
            ->route('listing-requests.edit', $listingRequest)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ListingRequest $listingRequest
    ): RedirectResponse {
        $this->authorize('delete', $listingRequest);

        $listingRequest->delete();

        return redirect()
            ->route('listing-requests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
