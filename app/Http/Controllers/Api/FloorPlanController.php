<?php

namespace App\Http\Controllers\Api;

use App\Models\FloorPlan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\FloorPlanResource;
use App\Http\Resources\FloorPlanCollection;
use App\Http\Requests\FloorPlanStoreRequest;
use App\Http\Requests\FloorPlanUpdateRequest;

class FloorPlanController extends Controller
{
    public function index(Request $request): FloorPlanCollection
    {
        $this->authorize('view-any', FloorPlan::class);

        $search = $request->get('search', '');

        $floorPlans = FloorPlan::search($search)
            ->latest()
            ->paginate();

        return new FloorPlanCollection($floorPlans);
    }

    public function store(FloorPlanStoreRequest $request): FloorPlanResource
    {
        $this->authorize('create', FloorPlan::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $floorPlan = FloorPlan::create($validated);

        return new FloorPlanResource($floorPlan);
    }

    public function show(
        Request $request,
        FloorPlan $floorPlan
    ): FloorPlanResource {
        $this->authorize('view', $floorPlan);

        return new FloorPlanResource($floorPlan);
    }

    public function update(
        FloorPlanUpdateRequest $request,
        FloorPlan $floorPlan
    ): FloorPlanResource {
        $this->authorize('update', $floorPlan);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($floorPlan->image) {
                Storage::delete($floorPlan->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $floorPlan->update($validated);

        return new FloorPlanResource($floorPlan);
    }

    public function destroy(Request $request, FloorPlan $floorPlan): Response
    {
        $this->authorize('delete', $floorPlan);

        if ($floorPlan->image) {
            Storage::delete($floorPlan->image);
        }

        $floorPlan->delete();

        return response()->noContent();
    }
}
