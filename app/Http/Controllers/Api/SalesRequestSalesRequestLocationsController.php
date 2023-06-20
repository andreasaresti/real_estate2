<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestLocationResource;
use App\Http\Resources\SalesRequestLocationCollection;

class SalesRequestSalesRequestLocationsController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestLocationCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $salesRequestLocations = $salesRequest
            ->salesRequestLocations()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestLocationCollection($salesRequestLocations);
    }

    public function store(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestLocationResource {
        $this->authorize('create', SalesRequestLocation::class);

        $validated = $request->validate([
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        $salesRequestLocation = $salesRequest
            ->salesRequestLocations()
            ->create($validated);

        return new SalesRequestLocationResource($salesRequestLocation);
    }
}
