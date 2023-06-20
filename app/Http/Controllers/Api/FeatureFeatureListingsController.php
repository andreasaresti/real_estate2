<?php

namespace App\Http\Controllers\Api;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureListingResource;
use App\Http\Resources\FeatureListingCollection;

class FeatureFeatureListingsController extends Controller
{
    public function index(
        Request $request,
        Feature $feature
    ): FeatureListingCollection {
        $this->authorize('view', $feature);

        $search = $request->get('search', '');

        $featureListings = $feature
            ->featureListings()
            ->search($search)
            ->latest()
            ->paginate();

        return new FeatureListingCollection($featureListings);
    }

    public function store(
        Request $request,
        Feature $feature
    ): FeatureListingResource {
        $this->authorize('create', FeatureListing::class);

        $validated = $request->validate([
            'listing_id' => ['required', 'exists:listings,id'],
        ]);

        $featureListing = $feature->featureListings()->create($validated);

        return new FeatureListingResource($featureListing);
    }
}
