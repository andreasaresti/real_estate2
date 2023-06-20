<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\SalesRequestAppointment;
use App\Http\Resources\SalesRequestAppointmentResource;
use App\Http\Resources\SalesRequestAppointmentCollection;
use App\Http\Requests\SalesRequestAppointmentStoreRequest;
use App\Http\Requests\SalesRequestAppointmentUpdateRequest;

class SalesRequestAppointmentController extends Controller
{
    public function index(Request $request): SalesRequestAppointmentCollection
    {
        $this->authorize('view-any', SalesRequestAppointment::class);

        $search = $request->get('search', '');

        $salesRequestAppointments = SalesRequestAppointment::search($search)
            ->latest()
            ->paginate();

        return new SalesRequestAppointmentCollection($salesRequestAppointments);
    }

    public function store(
        SalesRequestAppointmentStoreRequest $request
    ): SalesRequestAppointmentResource {
        $this->authorize('create', SalesRequestAppointment::class);

        $validated = $request->validated();

        $salesRequestAppointment = SalesRequestAppointment::create($validated);

        return new SalesRequestAppointmentResource($salesRequestAppointment);
    }

    public function show(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): SalesRequestAppointmentResource {
        $this->authorize('view', $salesRequestAppointment);

        return new SalesRequestAppointmentResource($salesRequestAppointment);
    }

    public function update(
        SalesRequestAppointmentUpdateRequest $request,
        SalesRequestAppointment $salesRequestAppointment
    ): SalesRequestAppointmentResource {
        $this->authorize('update', $salesRequestAppointment);

        $validated = $request->validated();

        $salesRequestAppointment->update($validated);

        return new SalesRequestAppointmentResource($salesRequestAppointment);
    }

    public function destroy(
        Request $request,
        SalesRequestAppointment $salesRequestAppointment
    ): Response {
        $this->authorize('delete', $salesRequestAppointment);

        $salesRequestAppointment->delete();

        return response()->noContent();
    }
}
