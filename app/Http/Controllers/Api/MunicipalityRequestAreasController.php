<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestAreaResource;
use App\Http\Resources\RequestAreaCollection;

class MunicipalityRequestAreasController extends Controller
{
    public function index(
        Request $request,
        Municipality $municipality
    ): RequestAreaCollection {
        $this->authorize('view', $municipality);

        $search = $request->get('search', '');

        $requestAreas = $municipality
            ->requestAreas()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestAreaCollection($requestAreas);
    }

    public function store(
        Request $request,
        Municipality $municipality
    ): RequestAreaResource {
        $this->authorize('create', RequestArea::class);

        $validated = $request->validate([
            'listingRequest_id' => ['required', 'exists:listing_requests,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        $requestArea = $municipality->requestAreas()->create($validated);

        return new RequestAreaResource($requestArea);
    }
}
