<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingRequestResource;
use App\Http\Resources\ListingRequestCollection;

class CustomerListingRequestsController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): ListingRequestCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $listingRequests = $customer
            ->listingRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingRequestCollection($listingRequests);
    }

    public function store(
        Request $request,
        Customer $customer
    ): ListingRequestResource {
        $this->authorize('create', ListingRequest::class);

        $validated = $request->validate([
            'date_created' => ['required', 'date'],
            'source_id' => ['required', 'exists:sources,id'],
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
        ]);

        $listingRequest = $customer->listingRequests()->create($validated);

        return new ListingRequestResource($listingRequest);
    }
}
