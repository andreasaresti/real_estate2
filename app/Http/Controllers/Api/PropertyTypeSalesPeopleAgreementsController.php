<?php

namespace App\Http\Controllers\Api;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleAgreementResource;
use App\Http\Resources\SalesPeopleAgreementCollection;

class PropertyTypeSalesPeopleAgreementsController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): SalesPeopleAgreementCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $salesPeopleAgreements = $propertyType
            ->salesPeopleAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleAgreementCollection($salesPeopleAgreements);
    }

    public function store(
        Request $request,
        PropertyType $propertyType
    ): SalesPeopleAgreementResource {
        $this->authorize('create', SalesPeopleAgreement::class);

        $validated = $request->validate([
            'sales_people_id' => ['required', 'exists:sales_people,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ]);

        $salesPeopleAgreement = $propertyType
            ->salesPeopleAgreements()
            ->create($validated);

        return new SalesPeopleAgreementResource($salesPeopleAgreement);
    }
}
