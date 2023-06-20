<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\District;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CustomerAgreement;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CustomerAgreementStoreRequest;
use App\Http\Requests\CustomerAgreementUpdateRequest;

class CustomerAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', CustomerAgreement::class);

        $search = $request->get('search', '');

        $customerAgreements = CustomerAgreement::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.customer_agreements.index',
            compact('customerAgreements', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', CustomerAgreement::class);

        $customers = Customer::pluck('name', 'id');
        $districts = District::pluck('name', 'id');

        return view(
            'app.customer_agreements.create',
            compact('customers', 'districts')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        CustomerAgreementStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', CustomerAgreement::class);

        $validated = $request->validated();

        $customerAgreement = CustomerAgreement::create($validated);

        return redirect()
            ->route('customer-agreements.edit', $customerAgreement)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        CustomerAgreement $customerAgreement
    ): View {
        $this->authorize('view', $customerAgreement);

        return view(
            'app.customer_agreements.show',
            compact('customerAgreement')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        CustomerAgreement $customerAgreement
    ): View {
        $this->authorize('update', $customerAgreement);

        $customers = Customer::pluck('name', 'id');
        $districts = District::pluck('name', 'id');

        return view(
            'app.customer_agreements.edit',
            compact('customerAgreement', 'customers', 'districts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CustomerAgreementUpdateRequest $request,
        CustomerAgreement $customerAgreement
    ): RedirectResponse {
        $this->authorize('update', $customerAgreement);

        $validated = $request->validated();

        $customerAgreement->update($validated);

        return redirect()
            ->route('customer-agreements.edit', $customerAgreement)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        CustomerAgreement $customerAgreement
    ): RedirectResponse {
        $this->authorize('delete', $customerAgreement);

        $customerAgreement->delete();

        return redirect()
            ->route('customer-agreements.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
