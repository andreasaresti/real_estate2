<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\SalesPeople;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesPeopleStoreRequest;
use App\Http\Requests\SalesPeopleUpdateRequest;

class SalesPeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesPeople::class);

        $search = $request->get('search', '');

        $allSalesPeople = SalesPeople::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_sales_people.index',
            compact('allSalesPeople', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesPeople::class);

        $customers = Customer::pluck('name', 'id');
        $agents = Agent::pluck('name', 'id');

        return view(
            'app.all_sales_people.create',
            compact('customers', 'agents')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesPeopleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SalesPeople::class);

        $validated = $request->validated();

        $salesPeople = SalesPeople::create($validated);

        return redirect()
            ->route('all-sales-people.edit', $salesPeople)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SalesPeople $salesPeople): View
    {
        $this->authorize('view', $salesPeople);

        return view('app.all_sales_people.show', compact('salesPeople'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SalesPeople $salesPeople): View
    {
        $this->authorize('update', $salesPeople);

        $customers = Customer::pluck('name', 'id');
        $agents = Agent::pluck('name', 'id');

        return view(
            'app.all_sales_people.edit',
            compact('salesPeople', 'customers', 'agents')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesPeopleUpdateRequest $request,
        SalesPeople $salesPeople
    ): RedirectResponse {
        $this->authorize('update', $salesPeople);

        $validated = $request->validated();

        $salesPeople->update($validated);

        return redirect()
            ->route('all-sales-people.edit', $salesPeople)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesPeople $salesPeople
    ): RedirectResponse {
        $this->authorize('delete', $salesPeople);

        $salesPeople->delete();

        return redirect()
            ->route('all-sales-people.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
