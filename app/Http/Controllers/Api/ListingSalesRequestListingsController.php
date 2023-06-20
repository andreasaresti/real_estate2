<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestListingResource;
use App\Http\Resources\SalesRequestListingCollection;

class ListingSalesRequestListingsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): SalesRequestListingCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $salesRequestListings = $listing
            ->salesRequestListings()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestListingCollection($salesRequestListings);
    }

    public function store(
        Request $request,
        Listing $listing
    ): SalesRequestListingResource {
        $this->authorize('create', SalesRequestListing::class);

        $validated = $request->validate([
            'status' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesRequestListing = $listing
            ->salesRequestListings()
            ->create($validated);

        return new SalesRequestListingResource($salesRequestListing);
    }
}
