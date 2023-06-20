<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestAreaResource;
use App\Http\Resources\RequestAreaCollection;

class LocationRequestAreasController extends Controller
{
    public function index(
        Request $request,
        Location $location
    ): RequestAreaCollection {
        $this->authorize('view', $location);

        $search = $request->get('search', '');

        $requestAreas = $location
            ->requestAreas()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestAreaCollection($requestAreas);
    }

    public function store(
        Request $request,
        Location $location
    ): RequestAreaResource {
        $this->authorize('create', RequestArea::class);

        $validated = $request->validate([
            'listingRequest_id' => ['required', 'exists:listing_requests,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $requestArea = $location->requestAreas()->create($validated);

        return new RequestAreaResource($requestArea);
    }
}
