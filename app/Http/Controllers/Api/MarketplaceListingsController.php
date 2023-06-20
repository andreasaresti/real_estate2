<?php
namespace App\Http\Controllers\Api;

use App\Models\Listing;
use App\Models\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingCollection;

class MarketplaceListingsController extends Controller
{
    public function index(
        Request $request,
        Marketplace $marketplace
    ): ListingCollection {
        $this->authorize('view', $marketplace);

        $search = $request->get('search', '');

        $listings = $marketplace
            ->listings()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingCollection($listings);
    }

    public function store(
        Request $request,
        Marketplace $marketplace,
        Listing $listing
    ): Response {
        $this->authorize('update', $marketplace);

        $marketplace->listings()->syncWithoutDetaching([$listing->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Marketplace $marketplace,
        Listing $listing
    ): Response {
        $this->authorize('update', $marketplace);

        $marketplace->listings()->detach($listing);

        return response()->noContent();
    }
}
