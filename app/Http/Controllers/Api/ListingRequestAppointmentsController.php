<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestAppointmentResource;
use App\Http\Resources\RequestAppointmentCollection;

class ListingRequestAppointmentsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): RequestAppointmentCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $requestAppointments = $listing
            ->requestAppointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestAppointmentCollection($requestAppointments);
    }

    public function store(
        Request $request,
        Listing $listing
    ): RequestAppointmentResource {
        $this->authorize('create', RequestAppointment::class);

        $validated = $request->validate([]);

        $requestAppointment = $listing
            ->requestAppointments()
            ->create($validated);

        return new RequestAppointmentResource($requestAppointment);
    }
}
