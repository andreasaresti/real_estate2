<?php

namespace App\Http\Controllers\Api;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerAgreementResource;
use App\Http\Resources\CustomerAgreementCollection;

class PropertyTypeCustomerAgreementsController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): CustomerAgreementCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $customerAgreements = $propertyType
            ->customerAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerAgreementCollection($customerAgreements);
    }

    public function store(
        Request $request,
        PropertyType $propertyType
    ): CustomerAgreementResource {
        $this->authorize('create', CustomerAgreement::class);

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'district_id' => ['required', 'exists:districts,id'],
            'agency_commission_percentage' => ['required', 'numeric'],
        ]);

        $customerAgreement = $propertyType
            ->customerAgreements()
            ->create($validated);

        return new CustomerAgreementResource($customerAgreement);
    }
}
