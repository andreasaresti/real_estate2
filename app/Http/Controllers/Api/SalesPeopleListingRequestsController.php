<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingRequestResource;
use App\Http\Resources\ListingRequestCollection;

class SalesPeopleListingRequestsController extends Controller
{
    public function index(
        Request $request,
        SalesPeople $salesPeople
    ): ListingRequestCollection {
        $this->authorize('view', $salesPeople);

        $search = $request->get('search', '');

        $listingRequests = $salesPeople
            ->listingRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingRequestCollection($listingRequests);
    }

    public function store(
        Request $request,
        SalesPeople $salesPeople
    ): ListingRequestResource {
        $this->authorize('create', ListingRequest::class);

        $validated = $request->validate([
            'date_created' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'source_id' => ['required', 'exists:sources,id'],
        ]);

        $listingRequest = $salesPeople->listingRequests()->create($validated);

        return new ListingRequestResource($listingRequest);
    }
}
