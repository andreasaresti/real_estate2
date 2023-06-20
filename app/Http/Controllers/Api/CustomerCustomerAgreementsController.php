<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerAgreementResource;
use App\Http\Resources\CustomerAgreementCollection;

class CustomerCustomerAgreementsController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): CustomerAgreementCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $customerAgreements = $customer
            ->customerAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerAgreementCollection($customerAgreements);
    }

    public function store(
        Request $request,
        Customer $customer
    ): CustomerAgreementResource {
        $this->authorize('create', CustomerAgreement::class);

        $validated = $request->validate([
            'district_id' => ['required', 'exists:districts,id'],
            'agency_commission_percentage' => ['required', 'numeric'],
        ]);

        $customerAgreement = $customer
            ->customerAgreements()
            ->create($validated);

        return new CustomerAgreementResource($customerAgreement);
    }
}
