<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureListingResource;
use App\Http\Resources\FeatureListingCollection;

class ListingFeatureListingsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): FeatureListingCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $featureListings = $listing
            ->featureListings()
            ->search($search)
            ->latest()
            ->paginate();

        return new FeatureListingCollection($featureListings);
    }

    public function store(
        Request $request,
        Listing $listing
    ): FeatureListingResource {
        $this->authorize('create', FeatureListing::class);

        $validated = $request->validate([
            'feature_id' => ['required', 'exists:features,id'],
        ]);

        $featureListing = $listing->featureListings()->create($validated);

        return new FeatureListingResource($featureListing);
    }
}
