<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MunicipalityResource;
use App\Http\Resources\MunicipalityCollection;

class DistrictMunicipalitiesController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): MunicipalityCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $municipalities = $district
            ->municipalities()
            ->search($search)
            ->latest()
            ->paginate();

        return new MunicipalityCollection($municipalities);
    }

    public function store(
        Request $request,
        District $district
    ): MunicipalityResource {
        $this->authorize('create', Municipality::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'json'],
            'ext_code' => [
                'nullable',
                'unique:municipalities,ext_code',
                'max:255',
                'string',
            ],
            'sequence' => ['required', 'numeric'],
        ]);

        $municipality = $district->municipalities()->create($validated);

        return new MunicipalityResource($municipality);
    }
}
