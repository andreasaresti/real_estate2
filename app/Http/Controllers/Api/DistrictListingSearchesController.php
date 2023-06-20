<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingSearchResource;
use App\Http\Resources\ListingSearchCollection;

class DistrictListingSearchesController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): ListingSearchCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $listingSearches = $district
            ->listingSearches()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingSearchCollection($listingSearches);
    }

    public function store(
        Request $request,
        District $district
    ): ListingSearchResource {
        $this->authorize('create', ListingSearch::class);

        $validated = $request->validate([
            'municipality_id' => ['required', 'exists:municipalities,id'],
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        $listingSearch = $district->listingSearches()->create($validated);

        return new ListingSearchResource($listingSearch);
    }
}
