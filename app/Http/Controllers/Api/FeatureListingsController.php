<?php
namespace App\Http\Controllers\Api;

use App\Models\Feature;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingCollection;

class FeatureListingsController extends Controller
{
    public function index(Request $request, Feature $feature): ListingCollection
    {
        $this->authorize('view', $feature);

        $search = $request->get('search', '');

        $listings = $feature
            ->listings()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingCollection($listings);
    }

    public function store(
        Request $request,
        Feature $feature,
        Listing $listing
    ): Response {
        $this->authorize('update', $feature);

        $feature->listings()->syncWithoutDetaching([$listing->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Feature $feature,
        Listing $listing
    ): Response {
        $this->authorize('update', $feature);

        $feature->listings()->detach($listing);

        return response()->noContent();
    }
}
