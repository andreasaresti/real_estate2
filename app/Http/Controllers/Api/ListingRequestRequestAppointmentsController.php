<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ListingRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestAppointmentResource;
use App\Http\Resources\RequestAppointmentCollection;

class ListingRequestRequestAppointmentsController extends Controller
{
    public function index(
        Request $request,
        ListingRequest $listingRequest
    ): RequestAppointmentCollection {
        $this->authorize('view', $listingRequest);

        $search = $request->get('search', '');

        $requestAppointments = $listingRequest
            ->requestAppointments()
            ->search($search)
            ->latest()
            ->paginate();

        return new RequestAppointmentCollection($requestAppointments);
    }

    public function store(
        Request $request,
        ListingRequest $listingRequest
    ): RequestAppointmentResource {
        $this->authorize('create', RequestAppointment::class);

        $validated = $request->validate([]);

        $requestAppointment = $listingRequest
            ->requestAppointments()
            ->create($validated);

        return new RequestAppointmentResource($requestAppointment);
    }
}
