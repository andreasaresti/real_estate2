<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestListingTypeResource;
use App\Http\Resources\SalesRequestListingTypeCollection;

class SalesRequestSalesRequestListingTypesController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestListingTypeCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $salesRequestListingTypes = $salesRequest
            ->salesRequestListingTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestListingTypeCollection($salesRequestListingTypes);
    }

    public function store(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestListingTypeResource {
        $this->authorize('create', SalesRequestListingType::class);

        $validated = $request->validate([
            'listing_type_id' => ['required', 'exists:listing_types,id'],
        ]);

        $salesRequestListingType = $salesRequest
            ->salesRequestListingTypes()
            ->create($validated);

        return new SalesRequestListingTypeResource($salesRequestListingType);
    }
}
