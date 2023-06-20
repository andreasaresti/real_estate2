<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestListingResource;
use App\Http\Resources\RequestListingCollection;

class ListingRequestListingsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): RequestListingCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $requestListings = $listing
            ->requestListings()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestListingCollection($requestListings);
    }

    public function store(
        Request $request,
        Listing $listing
    ): RequestListingResource {
        $this->authorize('create', RequestListing::class);

        $validated = $request->validate([]);

        $requestListing = $listing->requestListings()->create($validated);

        return new RequestListingResource($requestListing);
    }
}
