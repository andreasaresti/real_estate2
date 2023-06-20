<?php
namespace App\Http\Controllers\Api;

use App\Models\Listing;
use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureCollection;

class ListingFeaturesController extends Controller
{
    public function index(Request $request, Listing $listing): FeatureCollection
    {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $features = $listing
            ->features()
            ->search($search)
            ->latest()
            ->paginate();

        return new FeatureCollection($features);
    }

    public function store(
        Request $request,
        Listing $listing,
        Feature $feature
    ): Response {
        $this->authorize('update', $listing);

        $listing->features()->syncWithoutDetaching([$feature->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Listing $listing,
        Feature $feature
    ): Response {
        $this->authorize('update', $listing);

        $listing->features()->detach($feature);

        return response()->noContent();
    }
}
