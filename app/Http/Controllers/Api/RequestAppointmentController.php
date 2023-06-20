<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\RequestAppointment;
use App\Http\Controllers\Controller;
use App\Http\Resources\RequestAppointmentResource;
use App\Http\Resources\RequestAppointmentCollection;
use App\Http\Requests\RequestAppointmentStoreRequest;
use App\Http\Requests\RequestAppointmentUpdateRequest;

class RequestAppointmentController extends Controller
{
    public function index(Request $request): RequestAppointmentCollection
    {
        $this->authorize('view-any', RequestAppointment::class);

        $search = $request->get('search', '');

        $requestAppointments = RequestAppointment::search($search)
            ->latest()
            ->paginate();

        return new RequestAppointmentCollection($requestAppointments);
    }

    public function store(
        RequestAppointmentStoreRequest $request
    ): RequestAppointmentResource {
        $this->authorize('create', RequestAppointment::class);

        $validated = $request->validated();

        $requestAppointment = RequestAppointment::create($validated);

        return new RequestAppointmentResource($requestAppointment);
    }

    public function show(
        Request $request,
        RequestAppointment $requestAppointment
    ): RequestAppointmentResource {
        $this->authorize('view', $requestAppointment);

        return new RequestAppointmentResource($requestAppointment);
    }

    public function update(
        RequestAppointmentUpdateRequest $request,
        RequestAppointment $requestAppointment
    ): RequestAppointmentResource {
        $this->authorize('update', $requestAppointment);

        $validated = $request->validated();

        $requestAppointment->update($validated);

        return new RequestAppointmentResource($requestAppointment);
    }

    public function destroy(
        Request $request,
        RequestAppointment $requestAppointment
    ): Response {
        $this->authorize('delete', $requestAppointment);

        $requestAppointment->delete();

        return response()->noContent();
    }
}
