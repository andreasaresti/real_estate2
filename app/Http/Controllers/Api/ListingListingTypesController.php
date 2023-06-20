<?php
namespace App\Http\Controllers\Api;

use App\Models\Listing;
use App\Models\ListingType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingTypeCollection;

class ListingListingTypesController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): ListingTypeCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $listingTypes = $listing
            ->listingTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingTypeCollection($listingTypes);
    }

    public function store(
        Request $request,
        Listing $listing,
        ListingType $listingType
    ): Response {
        $this->authorize('update', $listing);

        $listing->listingTypes()->syncWithoutDetaching([$listingType->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Listing $listing,
        ListingType $listingType
    ): Response {
        $this->authorize('update', $listing);

        $listing->listingTypes()->detach($listingType);

        return response()->noContent();
    }
}
