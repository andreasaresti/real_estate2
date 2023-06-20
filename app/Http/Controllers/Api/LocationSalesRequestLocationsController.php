<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestLocationResource;
use App\Http\Resources\SalesRequestLocationCollection;

class LocationSalesRequestLocationsController extends Controller
{
    public function index(
        Request $request,
        Location $location
    ): SalesRequestLocationCollection {
        $this->authorize('view', $location);

        $search = $request->get('search', '');

        $salesRequestLocations = $location
            ->salesRequestLocations()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestLocationCollection($salesRequestLocations);
    }

    public function store(
        Request $request,
        Location $location
    ): SalesRequestLocationResource {
        $this->authorize('create', SalesRequestLocation::class);

        $validated = $request->validate([
            'salesRequest_id' => ['required', 'exists:sales_requests,id'],
        ]);

        $salesRequestLocation = $location
            ->salesRequestLocations()
            ->create($validated);

        return new SalesRequestLocationResource($salesRequestLocation);
    }
}
