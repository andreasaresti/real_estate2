<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\FloorPlan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FloorPlanStoreRequest;
use App\Http\Requests\FloorPlanUpdateRequest;

class FloorPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', FloorPlan::class);

        $search = $request->get('search', '');

        $floorPlans = FloorPlan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.floor_plans.index', compact('floorPlans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', FloorPlan::class);

        $listings = Listing::pluck('name', 'id');

        return view('app.floor_plans.create', compact('listings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FloorPlanStoreRequest $request): RedirectResponse
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

        return redirect()
            ->route('floor-plans.edit', $floorPlan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, FloorPlan $floorPlan): View
    {
        $this->authorize('view', $floorPlan);

        return view('app.floor_plans.show', compact('floorPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FloorPlan $floorPlan): View
    {
        $this->authorize('update', $floorPlan);

        $listings = Listing::pluck('name', 'id');

        return view('app.floor_plans.edit', compact('floorPlan', 'listings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FloorPlanUpdateRequest $request,
        FloorPlan $floorPlan
    ): RedirectResponse {
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

        return redirect()
            ->route('floor-plans.edit', $floorPlan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        FloorPlan $floorPlan
    ): RedirectResponse {
        $this->authorize('delete', $floorPlan);

        if ($floorPlan->image) {
            Storage::delete($floorPlan->image);
        }

        $floorPlan->delete();

        return redirect()
            ->route('floor-plans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
