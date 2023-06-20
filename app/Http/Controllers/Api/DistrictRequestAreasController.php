<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestAreaResource;
use App\Http\Resources\RequestAreaCollection;

class DistrictRequestAreasController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): RequestAreaCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $requestAreas = $district
            ->requestAreas()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestAreaCollection($requestAreas);
    }

    public function store(
        Request $request,
        District $district
    ): RequestAreaResource {
        $this->authorize('create', RequestArea::class);

        $validated = $request->validate([
            'listingRequest_id' => ['required', 'exists:listing_requests,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        $requestArea = $district->requestAreas()->create($validated);

        return new RequestAreaResource($requestArea);
    }
}
