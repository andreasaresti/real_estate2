<?php

namespace App\Http\Controllers\Api;

use App\Models\ListingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerAgreementResource;
use App\Http\Resources\CustomerAgreementCollection;

class ListingTypeCustomerAgreementsController extends Controller
{
    public function index(
        Request $request,
        ListingType $listingType
    ): CustomerAgreementCollection {
        $this->authorize('view', $listingType);

        $search = $request->get('search', '');

        $customerAgreements = $listingType
            ->customerAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerAgreementCollection($customerAgreements);
    }

    public function store(
        Request $request,
        ListingType $listingType
    ): CustomerAgreementResource {
        $this->authorize('create', CustomerAgreement::class);

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'agency_commission_percentage' => ['required', 'numeric'],
        ]);

        $customerAgreement = $listingType
            ->customerAgreements()
            ->create($validated);

        return new CustomerAgreementResource($customerAgreement);
    }
}
