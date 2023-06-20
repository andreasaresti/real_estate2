<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\View\View;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Models\SalesPeopleAgreement;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesPeopleAgreementStoreRequest;
use App\Http\Requests\SalesPeopleAgreementUpdateRequest;

class SalesPeopleAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesPeopleAgreement::class);

        $search = $request->get('search', '');

        $salesPeopleAgreements = SalesPeopleAgreement::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_people_agreements.index',
            compact('salesPeopleAgreements', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesPeopleAgreement::class);

        $allSalesPeople = SalesPeople::pluck('name', 'id');
        $districts = District::pluck('name', 'id');

        return view(
            'app.sales_people_agreements.create',
            compact('allSalesPeople', 'districts')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SalesPeopleAgreementStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SalesPeopleAgreement::class);

        $validated = $request->validated();

        $salesPeopleAgreement = SalesPeopleAgreement::create($validated);

        return redirect()
            ->route('sales-people-agreements.edit', $salesPeopleAgreement)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SalesPeopleAgreement $salesPeopleAgreement
    ): View {
        $this->authorize('view', $salesPeopleAgreement);

        return view(
            'app.sales_people_agreements.show',
            compact('salesPeopleAgreement')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SalesPeopleAgreement $salesPeopleAgreement
    ): View {
        $this->authorize('update', $salesPeopleAgreement);

        $allSalesPeople = SalesPeople::pluck('name', 'id');
        $districts = District::pluck('name', 'id');

        return view(
            'app.sales_people_agreements.edit',
            compact('salesPeopleAgreement', 'allSalesPeople', 'districts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesPeopleAgreementUpdateRequest $request,
        SalesPeopleAgreement $salesPeopleAgreement
    ): RedirectResponse {
        $this->authorize('update', $salesPeopleAgreement);

        $validated = $request->validated();

        $salesPeopleAgreement->update($validated);

        return redirect()
            ->route('sales-people-agreements.edit', $salesPeopleAgreement)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesPeopleAgreement $salesPeopleAgreement
    ): RedirectResponse {
        $this->authorize('delete', $salesPeopleAgreement);

        $salesPeopleAgreement->delete();

        return redirect()
            ->route('sales-people-agreements.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
