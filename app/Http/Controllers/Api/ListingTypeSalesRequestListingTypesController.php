<?php

namespace App\Http\Controllers\Api;

use App\Models\ListingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestListingTypeResource;
use App\Http\Resources\SalesRequestListingTypeCollection;

class ListingTypeSalesRequestListingTypesController extends Controller
{
    public function index(
        Request $request,
        ListingType $listingType
    ): SalesRequestListingTypeCollection {
        $this->authorize('view', $listingType);

        $search = $request->get('search', '');

        $salesRequestListingTypes = $listingType
            ->salesRequestListingTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestListingTypeCollection($salesRequestListingTypes);
    }

    public function store(
        Request $request,
        ListingType $listingType
    ): SalesRequestListingTypeResource {
        $this->authorize('create', SalesRequestListingType::class);

        $validated = $request->validate([
            'sales_request_id' => ['required', 'exists:sales_requests,id'],
        ]);

        $salesRequestListingType = $listingType
            ->salesRequestListingTypes()
            ->create($validated);

        return new SalesRequestListingTypeResource($salesRequestListingType);
    }
}
