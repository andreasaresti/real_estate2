<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MunicipalityResource;
use App\Http\Resources\MunicipalityCollection;
use App\Http\Requests\MunicipalityStoreRequest;
use App\Http\Requests\MunicipalityUpdateRequest;

class MunicipalityController extends Controller
{
    public function index(Request $request): MunicipalityCollection
    {
        $this->authorize('view-any', Municipality::class);

        $search = $request->get('search', '');

        $municipalities = Municipality::search($search)
            ->latest()
            ->paginate();

        return new MunicipalityCollection($municipalities);
    }

    public function store(
        MunicipalityStoreRequest $request
    ): MunicipalityResource {
        $this->authorize('create', Municipality::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $municipality = Municipality::create($validated);

        return new MunicipalityResource($municipality);
    }

    public function show(
        Request $request,
        Municipality $municipality
    ): MunicipalityResource {
        $this->authorize('view', $municipality);

        return new MunicipalityResource($municipality);
    }

    public function update(
        MunicipalityUpdateRequest $request,
        Municipality $municipality
    ): MunicipalityResource {
        $this->authorize('update', $municipality);

        $validated = $request->validated();

        $validated['name'] = json_decode($validated['name'], true);

        $municipality->update($validated);

        return new MunicipalityResource($municipality);
    }

    public function destroy(
        Request $request,
        Municipality $municipality
    ): Response {
        $this->authorize('delete', $municipality);

        $municipality->delete();

        return response()->noContent();
    }
}
