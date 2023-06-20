<?php

namespace App\Http\Controllers\Api;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\FeatureCollection;
use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;

class FeatureController extends Controller
{
    public function index(Request $request): FeatureCollection
    {
        $this->authorize('view-any', Feature::class);

        $search = $request->get('search', '');

        $features = Feature::search($search)
            ->latest()
            ->paginate();

        return new FeatureCollection($features);
    }

    public function store(FeatureStoreRequest $request): FeatureResource
    {
        $this->authorize('create', Feature::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $feature = Feature::create($validated);

        return new FeatureResource($feature);
    }

    public function show(Request $request, Feature $feature): FeatureResource
    {
        $this->authorize('view', $feature);

        return new FeatureResource($feature);
    }

    public function update(
        FeatureUpdateRequest $request,
        Feature $feature
    ): FeatureResource {
        $this->authorize('update', $feature);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($feature->image) {
                Storage::delete($feature->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $feature->update($validated);

        return new FeatureResource($feature);
    }

    public function destroy(Request $request, Feature $feature): Response
    {
        $this->authorize('delete', $feature);

        if ($feature->image) {
            Storage::delete($feature->image);
        }

        $feature->delete();

        return response()->noContent();
    }
}
