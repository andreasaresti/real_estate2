<?php

namespace App\Http\Controllers\Api;

use App\Models\ListingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleAgreementResource;
use App\Http\Resources\SalesPeopleAgreementCollection;

class ListingTypeSalesPeopleAgreementsController extends Controller
{
    public function index(
        Request $request,
        ListingType $listingType
    ): SalesPeopleAgreementCollection {
        $this->authorize('view', $listingType);

        $search = $request->get('search', '');

        $salesPeopleAgreements = $listingType
            ->salesPeopleAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleAgreementCollection($salesPeopleAgreements);
    }

    public function store(
        Request $request,
        ListingType $listingType
    ): SalesPeopleAgreementResource {
        $this->authorize('create', SalesPeopleAgreement::class);

        $validated = $request->validate([
            'sales_people_id' => ['required', 'exists:sales_people,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ]);

        $salesPeopleAgreement = $listingType
            ->salesPeopleAgreements()
            ->create($validated);

        return new SalesPeopleAgreementResource($salesPeopleAgreement);
    }
}
