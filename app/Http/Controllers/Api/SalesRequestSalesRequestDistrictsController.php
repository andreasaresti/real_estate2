<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestDistrictResource;
use App\Http\Resources\SalesRequestDistrictCollection;

class SalesRequestSalesRequestDistrictsController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestDistrictCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $salesRequestDistricts = $salesRequest
            ->salesRequestDistricts()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestDistrictCollection($salesRequestDistricts);
    }

    public function store(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestDistrictResource {
        $this->authorize('create', SalesRequestDistrict::class);

        $validated = $request->validate([
            'district_id' => ['required', 'exists:districts,id'],
        ]);

        $salesRequestDistrict = $salesRequest
            ->salesRequestDistricts()
            ->create($validated);

        return new SalesRequestDistrictResource($salesRequestDistrict);
    }
}
