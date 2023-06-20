<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleAgreementResource;
use App\Http\Resources\SalesPeopleAgreementCollection;

class DistrictSalesPeopleAgreementsController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): SalesPeopleAgreementCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $salesPeopleAgreements = $district
            ->salesPeopleAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleAgreementCollection($salesPeopleAgreements);
    }

    public function store(
        Request $request,
        District $district
    ): SalesPeopleAgreementResource {
        $this->authorize('create', SalesPeopleAgreement::class);

        $validated = $request->validate([
            'sales_people_id' => ['required', 'exists:sales_people,id'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ]);

        $salesPeopleAgreement = $district
            ->salesPeopleAgreements()
            ->create($validated);

        return new SalesPeopleAgreementResource($salesPeopleAgreement);
    }
}
