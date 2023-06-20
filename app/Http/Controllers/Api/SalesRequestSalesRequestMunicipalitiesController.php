<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestMunicipalityResource;
use App\Http\Resources\SalesRequestMunicipalityCollection;

class SalesRequestSalesRequestMunicipalitiesController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestMunicipalityCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $salesRequestMunicipalities = $salesRequest
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
        SalesRequest $salesRequest
    ): SalesRequestMunicipalityResource {
        $this->authorize('create', SalesRequestMunicipality::class);

        $validated = $request->validate([
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $salesRequestMunicipality = $salesRequest
            ->salesRequestMunicipalities()
            ->create($validated);

        return new SalesRequestMunicipalityResource($salesRequestMunicipality);
    }
}
