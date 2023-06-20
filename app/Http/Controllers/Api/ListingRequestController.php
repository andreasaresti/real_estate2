<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ListingRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingRequestResource;
use App\Http\Resources\ListingRequestCollection;
use App\Http\Requests\ListingRequestStoreRequest;
use App\Http\Requests\ListingRequestUpdateRequest;

class ListingRequestController extends Controller
{
    public function index(Request $request): ListingRequestCollection
    {
        $this->authorize('view-any', ListingRequest::class);

        $search = $request->get('search', '');

        $listingRequests = ListingRequest::search($search)
            ->latest()
            ->paginate();

        return new ListingRequestCollection($listingRequests);
    }

    public function store(
        ListingRequestStoreRequest $request
    ): ListingRequestResource {
        $this->authorize('create', ListingRequest::class);

        $validated = $request->validated();

        $listingRequest = ListingRequest::create($validated);

        return new ListingRequestResource($listingRequest);
    }

    public function show(
        Request $request,
        ListingRequest $listingRequest
    ): ListingRequestResource {
        $this->authorize('view', $listingRequest);

        return new ListingRequestResource($listingRequest);
    }

    public function update(
        ListingRequestUpdateRequest $request,
        ListingRequest $listingRequest
    ): ListingRequestResource {
        $this->authorize('update', $listingRequest);

        $validated = $request->validated();

        $listingRequest->update($validated);

        return new ListingRequestResource($listingRequest);
    }

    public function destroy(
        Request $request,
        ListingRequest $listingRequest
    ): Response {
        $this->authorize('delete', $listingRequest);

        $listingRequest->delete();

        return response()->noContent();
    }
}
