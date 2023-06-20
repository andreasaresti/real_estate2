<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CustomerAgreement;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerAgreementResource;
use App\Http\Resources\CustomerAgreementCollection;
use App\Http\Requests\CustomerAgreementStoreRequest;
use App\Http\Requests\CustomerAgreementUpdateRequest;

class CustomerAgreementController extends Controller
{
    public function index(Request $request): CustomerAgreementCollection
    {
        $this->authorize('view-any', CustomerAgreement::class);

        $search = $request->get('search', '');

        $customerAgreements = CustomerAgreement::search($search)
            ->latest()
            ->paginate();

        return new CustomerAgreementCollection($customerAgreements);
    }

    public function store(
        CustomerAgreementStoreRequest $request
    ): CustomerAgreementResource {
        $this->authorize('create', CustomerAgreement::class);

        $validated = $request->validated();

        $customerAgreement = CustomerAgreement::create($validated);

        return new CustomerAgreementResource($customerAgreement);
    }

    public function show(
        Request $request,
        CustomerAgreement $customerAgreement
    ): CustomerAgreementResource {
        $this->authorize('view', $customerAgreement);

        return new CustomerAgreementResource($customerAgreement);
    }

    public function update(
        CustomerAgreementUpdateRequest $request,
        CustomerAgreement $customerAgreement
    ): CustomerAgreementResource {
        $this->authorize('update', $customerAgreement);

        $validated = $request->validated();

        $customerAgreement->update($validated);

        return new CustomerAgreementResource($customerAgreement);
    }

    public function destroy(
        Request $request,
        CustomerAgreement $customerAgreement
    ): Response {
        $this->authorize('delete', $customerAgreement);

        $customerAgreement->delete();

        return response()->noContent();
    }
}
