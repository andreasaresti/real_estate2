<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestAppointmentResource;
use App\Http\Resources\SalesRequestAppointmentCollection;

class ListingSalesRequestAppointmentsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): SalesRequestAppointmentCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $salesRequestAppointments = $listing
            ->salesRequestAppointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestAppointmentCollection($salesRequestAppointments);
    }

    public function store(
        Request $request,
        Listing $listing
    ): SalesRequestAppointmentResource {
        $this->authorize('create', SalesRequestAppointment::class);

        $validated = $request->validate([
            'date' => ['required', 'date'],
        ]);

        $salesRequestAppointment = $listing
            ->salesRequestAppointments()
            ->create($validated);

        return new SalesRequestAppointmentResource($salesRequestAppointment);
    }
}
