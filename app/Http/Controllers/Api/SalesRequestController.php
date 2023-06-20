<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestResource;
use App\Http\Resources\SalesRequestCollection;
use App\Http\Requests\SalesRequestStoreRequest;
use App\Http\Requests\SalesRequestUpdateRequest;

class SalesRequestController extends Controller
{
    public function index(Request $request): SalesRequestCollection
    {
        $this->authorize('view-any', SalesRequest::class);

        $search = $request->get('search', '');

        $salesRequests = SalesRequest::search($search)
            ->latest()
            ->paginate();

        return new SalesRequestCollection($salesRequests);
    }

    public function store(
        SalesRequestStoreRequest $request
    ): SalesRequestResource {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validated();

        $salesRequest = SalesRequest::create($validated);

        return new SalesRequestResource($salesRequest);
    }

    public function show(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestResource {
        $this->authorize('view', $salesRequest);

        return new SalesRequestResource($salesRequest);
    }

    public function update(
        SalesRequestUpdateRequest $request,
        SalesRequest $salesRequest
    ): SalesRequestResource {
        $this->authorize('update', $salesRequest);

        $validated = $request->validated();

        $salesRequest->update($validated);

        return new SalesRequestResource($salesRequest);
    }

    public function destroy(
        Request $request,
        SalesRequest $salesRequest
    ): Response {
        $this->authorize('delete', $salesRequest);

        $salesRequest->delete();

        return response()->noContent();
    }
}
