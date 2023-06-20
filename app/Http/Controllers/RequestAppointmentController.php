<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ListingRequest;
use App\Models\RequestAppointment;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RequestAppointmentStoreRequest;
use App\Http\Requests\RequestAppointmentUpdateRequest;

class RequestAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', RequestAppointment::class);

        $search = $request->get('search', '');

        $requestAppointments = RequestAppointment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.request_appointments.index',
            compact('requestAppointments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', RequestAppointment::class);

        $listingRequests = ListingRequest::pluck('date_created', 'id');

        return view(
            'app.request_appointments.create',
            compact('listingRequests')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        RequestAppointmentStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', RequestAppointment::class);

        $validated = $request->validated();

        $requestAppointment = RequestAppointment::create($validated);

        return redirect()
            ->route('request-appointments.edit', $requestAppointment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        RequestAppointment $requestAppointment
    ): View {
        $this->authorize('view', $requestAppointment);

        return view(
            'app.request_appointments.show',
            compact('requestAppointment')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        RequestAppointment $requestAppointment
    ): View {
        $this->authorize('update', $requestAppointment);

        $listingRequests = ListingRequest::pluck('date_created', 'id');

        return view(
            'app.request_appointments.edit',
            compact('requestAppointment', 'listingRequests')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RequestAppointmentUpdateRequest $request,
        RequestAppointment $requestAppointment
    ): RedirectResponse {
        $this->authorize('update', $requestAppointment);

        $validated = $request->validated();

        $requestAppointment->update($validated);

        return redirect()
            ->route('request-appointments.edit', $requestAppointment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        RequestAppointment $requestAppointment
    ): RedirectResponse {
        $this->authorize('delete', $requestAppointment);

        $requestAppointment->delete();

        return redirect()
            ->route('request-appointments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
