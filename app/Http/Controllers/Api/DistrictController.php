<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictResource;
use App\Http\Resources\DistrictCollection;
use App\Http\Requests\DistrictStoreRequest;
use App\Http\Requests\DistrictUpdateRequest;

class DistrictController extends Controller
{
    public function index(Request $request): DistrictCollection
    {
        $this->authorize('view-any', District::class);

        $search = $request->get('search', '');

        $districts = District::search($search)
            ->latest()
            ->paginate();

        return new DistrictCollection($districts);
    }

    public function store(DistrictStoreRequest $request): DistrictResource
    {
        $this->authorize('create', District::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $district = District::create($validated);

        return new DistrictResource($district);
    }

    public function show(Request $request, District $district): DistrictResource
    {
        $this->authorize('view', $district);

        return new DistrictResource($district);
    }

    public function update(
        DistrictUpdateRequest $request,
        District $district
    ): DistrictResource {
        $this->authorize('update', $district);

        $validated = $request->validated();

        $validated['name'] = json_decode($validated['name'], true);

        $district->update($validated);

        return new DistrictResource($district);
    }

    public function destroy(Request $request, District $district): Response
    {
        $this->authorize('delete', $district);

        $district->delete();

        return response()->noContent();
    }
}
