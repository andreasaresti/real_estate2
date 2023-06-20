<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestAppointmentResource;
use App\Http\Resources\SalesRequestAppointmentCollection;

class SalesRequestSalesRequestAppointmentsController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestAppointmentCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $salesRequestAppointments = $salesRequest
            ->salesRequestAppointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestAppointmentCollection($salesRequestAppointments);
    }

    public function store(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestAppointmentResource {
        $this->authorize('create', SalesRequestAppointment::class);

        $validated = $request->validate([
            'listing_id' => ['required', 'exists:listings,id'],
            'date' => ['required', 'date'],
        ]);

        $salesRequestAppointment = $salesRequest
            ->salesRequestAppointments()
            ->create($validated);

        return new SalesRequestAppointmentResource($salesRequestAppointment);
    }
}
