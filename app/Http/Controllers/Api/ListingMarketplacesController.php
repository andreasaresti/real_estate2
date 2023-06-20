<?php
namespace App\Http\Controllers\Api;

use App\Models\Listing;
use App\Models\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MarketplaceCollection;

class ListingMarketplacesController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): MarketplaceCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $marketplaces = $listing
            ->marketplaces()
            ->search($search)
            ->latest()
            ->paginate();

        return new MarketplaceCollection($marketplaces);
    }

    public function store(
        Request $request,
        Listing $listing,
        Marketplace $marketplace
    ): Response {
        $this->authorize('update', $listing);

        $listing->marketplaces()->syncWithoutDetaching([$marketplace->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Listing $listing,
        Marketplace $marketplace
    ): Response {
        $this->authorize('update', $listing);

        $listing->marketplaces()->detach($marketplace);

        return response()->noContent();
    }
}
