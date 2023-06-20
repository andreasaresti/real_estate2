<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SalesRequestListing;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestListingResource;
use App\Http\Resources\SalesRequestListingCollection;
use App\Http\Requests\SalesRequestListingStoreRequest;
use App\Http\Requests\SalesRequestListingUpdateRequest;

class SalesRequestListingController extends Controller
{
    public function index(Request $request): SalesRequestListingCollection
    {
        $this->authorize('view-any', SalesRequestListing::class);

        $search = $request->get('search', '');

        $salesRequestListings = SalesRequestListing::search($search)
            ->latest()
            ->paginate();

        return new SalesRequestListingCollection($salesRequestListings);
    }

    public function store(
        SalesRequestListingStoreRequest $request
    ): SalesRequestListingResource {
        $this->authorize('create', SalesRequestListing::class);

        $validated = $request->validated();

        $salesRequestListing = SalesRequestListing::create($validated);

        return new SalesRequestListingResource($salesRequestListing);
    }

    public function show(
        Request $request,
        SalesRequestListing $salesRequestListing
    ): SalesRequestListingResource {
        $this->authorize('view', $salesRequestListing);

        return new SalesRequestListingResource($salesRequestListing);
    }

    public function update(
        SalesRequestListingUpdateRequest $request,
        SalesRequestListing $salesRequestListing
    ): SalesRequestListingResource {
        $this->authorize('update', $salesRequestListing);

        $validated = $request->validated();

        $salesRequestListing->update($validated);

        return new SalesRequestListingResource($salesRequestListing);
    }

    public function destroy(
        Request $request,
        SalesRequestListing $salesRequestListing
    ): Response {
        $this->authorize('delete', $salesRequestListing);

        $salesRequestListing->delete();

        return response()->noContent();
    }
}
