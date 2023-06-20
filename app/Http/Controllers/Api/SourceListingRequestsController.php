<?php

namespace App\Http\Controllers\Api;

use App\Models\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingRequestResource;
use App\Http\Resources\ListingRequestCollection;

class SourceListingRequestsController extends Controller
{
    public function index(
        Request $request,
        Source $source
    ): ListingRequestCollection {
        $this->authorize('view', $source);

        $search = $request->get('search', '');

        $listingRequests = $source
            ->listingRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingRequestCollection($listingRequests);
    }

    public function store(
        Request $request,
        Source $source
    ): ListingRequestResource {
        $this->authorize('create', ListingRequest::class);

        $validated = $request->validate([
            'date_created' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
        ]);

        $listingRequest = $source->listingRequests()->create($validated);

        return new ListingRequestResource($listingRequest);
    }
}
