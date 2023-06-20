<?php

namespace App\Http\Controllers\Api;

use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingSearchResource;
use App\Http\Resources\ListingSearchCollection;

class MunicipalityListingSearchesController extends Controller
{
    public function index(
        Request $request,
        Municipality $municipality
    ): ListingSearchCollection {
        $this->authorize('view', $municipality);

        $search = $request->get('search', '');

        $listingSearches = $municipality
            ->listingSearches()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingSearchCollection($listingSearches);
    }

    public function store(
        Request $request,
        Municipality $municipality
    ): ListingSearchResource {
        $this->authorize('create', ListingSearch::class);

        $validated = $request->validate([
            'district_id' => ['required', 'exists:districts,id'],
            'location_id' => ['required', 'exists:locations,id'],
        ]);

        $listingSearch = $municipality->listingSearches()->create($validated);

        return new ListingSearchResource($listingSearch);
    }
}
