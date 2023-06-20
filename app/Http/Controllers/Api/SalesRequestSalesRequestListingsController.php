<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestListingResource;
use App\Http\Resources\SalesRequestListingCollection;

class SalesRequestSalesRequestListingsController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestListingCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $salesRequestListings = $salesRequest
            ->salesRequestListings()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestListingCollection($salesRequestListings);
    }

    public function store(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestListingResource {
        $this->authorize('create', SalesRequestListing::class);

        $validated = $request->validate([
            'listing_id' => ['required', 'exists:listings,id'],
            'status' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesRequestListing = $salesRequest
            ->salesRequestListings()
            ->create($validated);

        return new SalesRequestListingResource($salesRequestListing);
    }
}
