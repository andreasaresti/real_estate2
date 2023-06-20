<?php

namespace App\Http\Controllers\Api;

use App\Models\ListingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingTypeRelationResource;
use App\Http\Resources\ListingTypeRelationCollection;

class ListingTypeListingTypeRelationsController extends Controller
{
    public function index(
        Request $request,
        ListingType $listingType
    ): ListingTypeRelationCollection {
        $this->authorize('view', $listingType);

        $search = $request->get('search', '');

        $listingTypeRelations = $listingType
            ->listingTypeRelations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingTypeRelationCollection($listingTypeRelations);
    }

    public function store(
        Request $request,
        ListingType $listingType
    ): ListingTypeRelationResource {
        $this->authorize('create', ListingTypeRelation::class);

        $validated = $request->validate([
            'listing_id' => ['required', 'exists:listings,id'],
        ]);

        $listingTypeRelation = $listingType
            ->listingTypeRelations()
            ->create($validated);

        return new ListingTypeRelationResource($listingTypeRelation);
    }
}
