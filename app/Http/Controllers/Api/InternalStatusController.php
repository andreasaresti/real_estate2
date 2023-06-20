<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\InternalStatus;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\InternalStatusResource;
use App\Http\Resources\InternalStatusCollection;
use App\Http\Requests\InternalStatusStoreRequest;
use App\Http\Requests\InternalStatusUpdateRequest;

class InternalStatusController extends Controller
{
    public function index(Request $request): InternalStatusCollection
    {
        $this->authorize('view-any', InternalStatus::class);

        $search = $request->get('search', '');

        $internalStatuses = InternalStatus::search($search)
            ->latest()
            ->paginate();

        return new InternalStatusCollection($internalStatuses);
    }

    public function store(
        InternalStatusStoreRequest $request
    ): InternalStatusResource {
        $this->authorize('create', InternalStatus::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $internalStatus = InternalStatus::create($validated);

        return new InternalStatusResource($internalStatus);
    }

    public function show(
        Request $request,
        InternalStatus $internalStatus
    ): InternalStatusResource {
        $this->authorize('view', $internalStatus);

        return new InternalStatusResource($internalStatus);
    }

    public function update(
        InternalStatusUpdateRequest $request,
        InternalStatus $internalStatus
    ): InternalStatusResource {
        $this->authorize('update', $internalStatus);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($internalStatus->image) {
                Storage::delete($internalStatus->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $internalStatus->update($validated);

        return new InternalStatusResource($internalStatus);
    }

    public function destroy(
        Request $request,
        InternalStatus $internalStatus
    ): Response {
        $this->authorize('delete', $internalStatus);

        if ($internalStatus->image) {
            Storage::delete($internalStatus->image);
        }

        $internalStatus->delete();

        return response()->noContent();
    }
}
