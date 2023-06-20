<?php
namespace App\Http\Controllers\Api;

use App\Models\Listing;
use App\Models\ListingType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingCollection;

class ListingTypeListingsController extends Controller
{
    public function index(
        Request $request,
        ListingType $listingType
    ): ListingCollection {
        $this->authorize('view', $listingType);

        $search = $request->get('search', '');

        $listings = $listingType
            ->listings()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingCollection($listings);
    }

    public function store(
        Request $request,
        ListingType $listingType,
        Listing $listing
    ): Response {
        $this->authorize('update', $listingType);

        $listingType->listings()->syncWithoutDetaching([$listing->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        ListingType $listingType,
        Listing $listing
    ): Response {
        $this->authorize('update', $listingType);

        $listingType->listings()->detach($listing);

        return response()->noContent();
    }
}
