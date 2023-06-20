<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Http\Resources\LocationCollection;

class MunicipalityLocationsController extends Controller
{
    public function index(
        Request $request,
        Municipality $municipality
    ): LocationCollection {
        $this->authorize('view', $municipality);

        $search = $request->get('search', '');

        $locations = $municipality
            ->locations()
            ->search($search)
            ->latest()
            ->paginate();

        return new LocationCollection($locations);
    }

    public function store(
        Request $request,
        Municipality $municipality
    ): LocationResource {
        $this->authorize('create', Location::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'json'],
            'ext_code' => [
                'nullable',
                'unique:locations,ext_code',
                'max:255',
                'string',
            ],
            'sequence' => ['required', 'numeric'],
        ]);

        $location = $municipality->locations()->create($validated);

        return new LocationResource($location);
    }
}
