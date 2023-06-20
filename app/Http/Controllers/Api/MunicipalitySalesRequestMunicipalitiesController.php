<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestMunicipalityResource;
use App\Http\Resources\SalesRequestMunicipalityCollection;

class MunicipalitySalesRequestMunicipalitiesController extends Controller
{
    public function index(
        Request $request,
        Municipality $municipality
    ): SalesRequestMunicipalityCollection {
        $this->authorize('view', $municipality);

        $search = $request->get('search', '');

        $salesRequestMunicipalities = $municipality
            ->salesRequestMunicipalities()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestMunicipalityCollection(
            $salesRequestMunicipalities
        );
    }

    public function store(
        Request $request,
        Municipality $municipality
    ): SalesRequestMunicipalityResource {
        $this->authorize('create', SalesRequestMunicipality::class);

        $validated = $request->validate([
            'salesRequest_id' => ['required', 'exists:sales_requests,id'],
        ]);

        $salesRequestMunicipality = $municipality
            ->salesRequestMunicipalities()
            ->create($validated);

        return new SalesRequestMunicipalityResource($salesRequestMunicipality);
    }
}
