<?php

namespace App\Http\Controllers;

use App\Models\Source;
use App\Models\Customer;
use Illuminate\View\View;
use App\Models\SalesPeople;
use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesRequestStoreRequest;
use App\Http\Requests\SalesRequestUpdateRequest;

class SalesRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesRequest::class);

        $search = $request->get('search', '');

        $salesRequests = SalesRequest::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_requests.index',
            compact('salesRequests', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesRequest::class);

        $customers = Customer::pluck('name', 'id');
        $sources = Source::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');
        $propertyTypes = PropertyType::pluck('name', 'id');

        return view(
            'app.sales_requests.create',
            compact('customers', 'sources', 'allSalesPeople', 'propertyTypes')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalesRequestStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validated();

        $salesRequest = SalesRequest::create($validated);

        return redirect()
            ->route('sales-requests.edit', $salesRequest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, SalesRequest $salesRequest): View
    {
        $this->authorize('view', $salesRequest);

        return view('app.sales_requests.show', compact('salesRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, SalesRequest $salesRequest): View
    {
        $this->authorize('update', $salesRequest);

        $customers = Customer::pluck('name', 'id');
        $sources = Source::pluck('name', 'id');
        $allSalesPeople = SalesPeople::pluck('name', 'id');
        $propertyTypes = PropertyType::pluck('name', 'id');

        return view(
            'app.sales_requests.edit',
            compact(
                'salesRequest',
                'customers',
                'sources',
                'allSalesPeople',
                'propertyTypes'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesRequestUpdateRequest $request,
        SalesRequest $salesRequest
    ): RedirectResponse {
        $this->authorize('update', $salesRequest);

        $validated = $request->validated();

        $salesRequest->update($validated);

        return redirect()
            ->route('sales-requests.edit', $salesRequest)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesRequest $salesRequest
    ): RedirectResponse {
        $this->authorize('delete', $salesRequest);

        $salesRequest->delete();

        return redirect()
            ->route('sales-requests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
