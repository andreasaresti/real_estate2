<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleAgreementResource;
use App\Http\Resources\SalesPeopleAgreementCollection;

class SalesPeopleSalesPeopleAgreementsController extends Controller
{
    public function index(
        Request $request,
        SalesPeople $salesPeople
    ): SalesPeopleAgreementCollection {
        $this->authorize('view', $salesPeople);

        $search = $request->get('search', '');

        $salesPeopleAgreements = $salesPeople
            ->salesPeopleAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleAgreementCollection($salesPeopleAgreements);
    }

    public function store(
        Request $request,
        SalesPeople $salesPeople
    ): SalesPeopleAgreementResource {
        $this->authorize('create', SalesPeopleAgreement::class);

        $validated = $request->validate([
            'district_id' => ['required', 'exists:districts,id'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ]);

        $salesPeopleAgreement = $salesPeople
            ->salesPeopleAgreements()
            ->create($validated);

        return new SalesPeopleAgreementResource($salesPeopleAgreement);
    }
}
