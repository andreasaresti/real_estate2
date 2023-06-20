<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SalesLostReason;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesLostReasonStoreRequest;
use App\Http\Requests\SalesLostReasonUpdateRequest;

class SalesLostReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesLostReason::class);

        $search = $request->get('search', '');

        $salesLostReasons = SalesLostReason::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_lost_reasons.index',
            compact('salesLostReasons', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesLostReason::class);

        return view('app.sales_lost_reasons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SalesLostReasonStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SalesLostReason::class);

        $validated = $request->validated();

        $salesLostReason = SalesLostReason::create($validated);

        return redirect()
            ->route('sales-lost-reasons.edit', $salesLostReason)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SalesLostReason $salesLostReason
    ): View {
        $this->authorize('view', $salesLostReason);

        return view('app.sales_lost_reasons.show', compact('salesLostReason'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SalesLostReason $salesLostReason
    ): View {
        $this->authorize('update', $salesLostReason);

        return view('app.sales_lost_reasons.edit', compact('salesLostReason'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesLostReasonUpdateRequest $request,
        SalesLostReason $salesLostReason
    ): RedirectResponse {
        $this->authorize('update', $salesLostReason);

        $validated = $request->validated();

        $salesLostReason->update($validated);

        return redirect()
            ->route('sales-lost-reasons.edit', $salesLostReason)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesLostReason $salesLostReason
    ): RedirectResponse {
        $this->authorize('delete', $salesLostReason);

        $salesLostReason->delete();

        return redirect()
            ->route('sales-lost-reasons.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
