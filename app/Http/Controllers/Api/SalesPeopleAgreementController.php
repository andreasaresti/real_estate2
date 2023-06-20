<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SalesPeopleAgreement;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleAgreementResource;
use App\Http\Resources\SalesPeopleAgreementCollection;
use App\Http\Requests\SalesPeopleAgreementStoreRequest;
use App\Http\Requests\SalesPeopleAgreementUpdateRequest;

class SalesPeopleAgreementController extends Controller
{
    public function index(Request $request): SalesPeopleAgreementCollection
    {
        $this->authorize('view-any', SalesPeopleAgreement::class);

        $search = $request->get('search', '');

        $salesPeopleAgreements = SalesPeopleAgreement::search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleAgreementCollection($salesPeopleAgreements);
    }

    public function store(
        SalesPeopleAgreementStoreRequest $request
    ): SalesPeopleAgreementResource {
        $this->authorize('create', SalesPeopleAgreement::class);

        $validated = $request->validated();

        $salesPeopleAgreement = SalesPeopleAgreement::create($validated);

        return new SalesPeopleAgreementResource($salesPeopleAgreement);
    }

    public function show(
        Request $request,
        SalesPeopleAgreement $salesPeopleAgreement
    ): SalesPeopleAgreementResource {
        $this->authorize('view', $salesPeopleAgreement);

        return new SalesPeopleAgreementResource($salesPeopleAgreement);
    }

    public function update(
        SalesPeopleAgreementUpdateRequest $request,
        SalesPeopleAgreement $salesPeopleAgreement
    ): SalesPeopleAgreementResource {
        $this->authorize('update', $salesPeopleAgreement);

        $validated = $request->validated();

        $salesPeopleAgreement->update($validated);

        return new SalesPeopleAgreementResource($salesPeopleAgreement);
    }

    public function destroy(
        Request $request,
        SalesPeopleAgreement $salesPeopleAgreement
    ): Response {
        $this->authorize('delete', $salesPeopleAgreement);

        $salesPeopleAgreement->delete();

        return response()->noContent();
    }
}
