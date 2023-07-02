<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SalesRequestNoteType;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestNoteTypeResource;
use App\Http\Resources\SalesRequestNoteTypeCollection;
use App\Http\Requests\SalesRequestNoteTypeStoreRequest;
use App\Http\Requests\SalesRequestNoteTypeUpdateRequest;

class SalesRequestNoteTypeController extends Controller
{
    public function index(Request $request): SalesRequestNoteTypeCollection
    {
        $this->authorize('view-any', SalesRequestNoteType::class);

        $search = $request->get('search', '');

        $salesRequestNoteTypes = SalesRequestNoteType::search($search)
            ->latest()
            ->paginate();

        return new SalesRequestNoteTypeCollection($salesRequestNoteTypes);
    }

    public function store(
        SalesRequestNoteTypeStoreRequest $request
    ): SalesRequestNoteTypeResource {
        $this->authorize('create', SalesRequestNoteType::class);

        $validated = $request->validated();

        $salesRequestNoteType = SalesRequestNoteType::create($validated);

        return new SalesRequestNoteTypeResource($salesRequestNoteType);
    }

    public function show(
        Request $request,
        SalesRequestNoteType $salesRequestNoteType
    ): SalesRequestNoteTypeResource {
        $this->authorize('view', $salesRequestNoteType);

        return new SalesRequestNoteTypeResource($salesRequestNoteType);
    }

    public function update(
        SalesRequestNoteTypeUpdateRequest $request,
        SalesRequestNoteType $salesRequestNoteType
    ): SalesRequestNoteTypeResource {
        $this->authorize('update', $salesRequestNoteType);

        $validated = $request->validated();

        $salesRequestNoteType->update($validated);

        return new SalesRequestNoteTypeResource($salesRequestNoteType);
    }

    public function destroy(
        Request $request,
        SalesRequestNoteType $salesRequestNoteType
    ): Response {
        $this->authorize('delete', $salesRequestNoteType);

        $salesRequestNoteType->delete();

        return response()->noContent();
    }
}
