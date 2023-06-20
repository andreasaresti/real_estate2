<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestDistrictResource;
use App\Http\Resources\SalesRequestDistrictCollection;

class DistrictSalesRequestDistrictsController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): SalesRequestDistrictCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $salesRequestDistricts = $district
            ->salesRequestDistricts()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestDistrictCollection($salesRequestDistricts);
    }

    public function store(
        Request $request,
        District $district
    ): SalesRequestDistrictResource {
        $this->authorize('create', SalesRequestDistrict::class);

        $validated = $request->validate([
            'salesRequest_id' => ['required', 'exists:sales_requests,id'],
        ]);

        $salesRequestDistrict = $district
            ->salesRequestDistricts()
            ->create($validated);

        return new SalesRequestDistrictResource($salesRequestDistrict);
    }
}
