<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FloorPlanResource;
use App\Http\Resources\FloorPlanCollection;

class ListingFloorPlansController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): FloorPlanCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $floorPlans = $listing
            ->floorPlans()
            ->search($search)
            ->latest()
            ->paginate();

        return new FloorPlanCollection($floorPlans);
    }

    public function store(Request $request, Listing $listing): FloorPlanResource
    {
        $this->authorize('create', FloorPlan::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'description' => ['required', 'max:255', 'json'],
            'sequence' => ['required', 'numeric'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $floorPlan = $listing->floorPlans()->create($validated);

        return new FloorPlanResource($floorPlan);
    }
}
