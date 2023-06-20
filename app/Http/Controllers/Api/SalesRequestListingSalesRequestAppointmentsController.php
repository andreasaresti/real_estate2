<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SalesRequestListing;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestAppointmentResource;
use App\Http\Resources\SalesRequestAppointmentCollection;

class SalesRequestListingSalesRequestAppointmentsController extends Controller
{
    public function index(
        Request $request,
        SalesRequestListing $salesRequestListing
    ): SalesRequestAppointmentCollection {
        $this->authorize('view', $salesRequestListing);

        $search = $request->get('search', '');

        $salesRequestAppointments = $salesRequestListing
            ->salesRequestAppointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestAppointmentCollection($salesRequestAppointments);
    }

    public function store(
        Request $request,
        SalesRequestListing $salesRequestListing
    ): SalesRequestAppointmentResource {
        $this->authorize('create', SalesRequestAppointment::class);

        $validated = $request->validate([
            'listing_id' => ['required', 'exists:listings,id'],
            'date' => ['required', 'date'],
        ]);

        $salesRequestAppointment = $salesRequestListing
            ->salesRequestAppointments()
            ->create($validated);

        return new SalesRequestAppointmentResource($salesRequestAppointment);
    }
}
