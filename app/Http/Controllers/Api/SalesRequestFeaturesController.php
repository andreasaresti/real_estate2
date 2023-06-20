<?php
namespace App\Http\Controllers\Api;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\SalesRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FeatureCollection;

class SalesRequestFeaturesController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): FeatureCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $features = $salesRequest
            ->features()
            ->search($search)
            ->latest()
            ->paginate();

        return new FeatureCollection($features);
    }

    public function store(
        Request $request,
        SalesRequest $salesRequest,
        Feature $feature
    ): Response {
        $this->authorize('update', $salesRequest);

        $salesRequest->features()->syncWithoutDetaching([$feature->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        SalesRequest $salesRequest,
        Feature $feature
    ): Response {
        $this->authorize('update', $salesRequest);

        $salesRequest->features()->detach($feature);

        return response()->noContent();
    }
}
