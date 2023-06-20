<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\SalesRequestAppointment;
use App\Http\Requests\SalesRequestAppointmentStoreRequest;
use App\Http\Requests\SalesRequestAppointmentUpdateRequest;

class SalesRequestAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesRequestAppointment::class);

        $search = $request->get('search', '');

        $salesRequestAppointments = SalesRequestAppointment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_request_appointments.index',
            compact('salesRequestAppointments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesRequestAppointment::class);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.sales_request_appointments.create',
            compact('listings')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SalesRequestAppointmentStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SalesRequestAppointment::class);

        $validated = $request->validated();

        $salesRequestAppointment = SalesRequestAppointment::create($validated);

        return redirect()
            ->route('sales-request-appointments.edit', $salesRequestAppointment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): View {
        $this->authorize('view', $salesRequestAppointment);

        return view(
            'app.sales_request_appointments.show',
            compact('salesRequestAppointment')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): View {
        $this->authorize('update', $salesRequestAppointment);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.sales_request_appointments.edit',
            compact('salesRequestAppointment', 'listings')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesRequestAppointmentUpdateRequest $request,
        SalesRequestAppointment $salesRequestAppointment
    ): RedirectResponse {
        $this->authorize('update', $salesRequestAppointment);

        $validated = $request->validated();

        $salesRequestAppointment->update($validated);

        return redirect()
            ->route('sales-request-appointments.edit', $salesRequestAppointment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): RedirectResponse {
        $this->authorize('delete', $salesRequestAppointment);

        $salesRequestAppointment->delete();

        return redirect()
            ->route('sales-request-appointments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
