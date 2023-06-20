<?php

namespace App\Http\Controllers\Api;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingSearchResource;
use App\Http\Resources\ListingSearchCollection;

class LocationListingSearchesController extends Controller
{
    public function index(
        Request $request,
        Location $location
    ): ListingSearchCollection {
        $this->authorize('view', $location);

        $search = $request->get('search', '');

        $listingSearches = $location
            ->listingSearches()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingSearchCollection($listingSearches);
    }

    public function store(
        Request $request,
        Location $location
    ): ListingSearchResource {
        $this->authorize('create', ListingSearch::class);

        $validated = $request->validate([
            'district_id' => ['required', 'exists:districts,id'],
            'municipality_id' => ['required', 'exists:municipalities,id'],
        ]);

        $listingSearch = $location->listingSearches()->create($validated);

        return new ListingSearchResource($listingSearch);
    }
}
