<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingTypeRelationResource;
use App\Http\Resources\ListingTypeRelationCollection;

class ListingListingTypeRelationsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): ListingTypeRelationCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $listingTypeRelations = $listing
            ->listingTypeRelations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingTypeRelationCollection($listingTypeRelations);
    }

    public function store(
        Request $request,
        Listing $listing
    ): ListingTypeRelationResource {
        $this->authorize('create', ListingTypeRelation::class);

        $validated = $request->validate([
            'listing_type_id' => ['required', 'exists:listing_types,id'],
        ]);

        $listingTypeRelation = $listing
            ->listingTypeRelations()
            ->create($validated);

        return new ListingTypeRelationResource($listingTypeRelation);
    }
}
