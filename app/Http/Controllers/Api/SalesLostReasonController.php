<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SalesLostReason;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesLostReasonResource;
use App\Http\Resources\SalesLostReasonCollection;
use App\Http\Requests\SalesLostReasonStoreRequest;
use App\Http\Requests\SalesLostReasonUpdateRequest;

class SalesLostReasonController extends Controller
{
    public function index(Request $request): SalesLostReasonCollection
    {
        $this->authorize('view-any', SalesLostReason::class);

        $search = $request->get('search', '');

        $salesLostReasons = SalesLostReason::search($search)
            ->latest()
            ->paginate();

        return new SalesLostReasonCollection($salesLostReasons);
    }

    public function store(
        SalesLostReasonStoreRequest $request
    ): SalesLostReasonResource {
        $this->authorize('create', SalesLostReason::class);

        $validated = $request->validated();

        $salesLostReason = SalesLostReason::create($validated);

        return new SalesLostReasonResource($salesLostReason);
    }

    public function show(
        Request $request,
        SalesLostReason $salesLostReason
    ): SalesLostReasonResource {
        $this->authorize('view', $salesLostReason);

        return new SalesLostReasonResource($salesLostReason);
    }

    public function update(
        SalesLostReasonUpdateRequest $request,
        SalesLostReason $salesLostReason
    ): SalesLostReasonResource {
        $this->authorize('update', $salesLostReason);

        $validated = $request->validated();

        $salesLostReason->update($validated);

        return new SalesLostReasonResource($salesLostReason);
    }

    public function destroy(
        Request $request,
        SalesLostReason $salesLostReason
    ): Response {
        $this->authorize('delete', $salesLostReason);

        $salesLostReason->delete();

        return response()->noContent();
    }
}
