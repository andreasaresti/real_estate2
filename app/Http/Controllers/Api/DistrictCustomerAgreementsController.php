<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerAgreementResource;
use App\Http\Resources\CustomerAgreementCollection;

class DistrictCustomerAgreementsController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): CustomerAgreementCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $customerAgreements = $district
            ->customerAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerAgreementCollection($customerAgreements);
    }

    public function store(
        Request $request,
        District $district
    ): CustomerAgreementResource {
        $this->authorize('create', CustomerAgreement::class);

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'agency_commission_percentage' => ['required', 'numeric'],
        ]);

        $customerAgreement = $district
            ->customerAgreements()
            ->create($validated);

        return new CustomerAgreementResource($customerAgreement);
    }
}
