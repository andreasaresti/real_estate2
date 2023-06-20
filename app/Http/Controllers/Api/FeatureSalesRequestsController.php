<?php
namespace App\Http\Controllers\Api;

use App\Models\Feature;
use Illuminate\Http\Request;
use App\Models\SalesRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestCollection;

class FeatureSalesRequestsController extends Controller
{
    public function index(
        Request $request,
        Feature $feature
    ): SalesRequestCollection {
        $this->authorize('view', $feature);

        $search = $request->get('search', '');

        $salesRequests = $feature
            ->salesRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestCollection($salesRequests);
    }

    public function store(
        Request $request,
        Feature $feature,
        SalesRequest $salesRequest
    ): Response {
        $this->authorize('update', $feature);

        $feature->salesRequests()->syncWithoutDetaching([$salesRequest->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Feature $feature,
        SalesRequest $salesRequest
    ): Response {
        $this->authorize('update', $feature);

        $feature->salesRequests()->detach($salesRequest);

        return response()->noContent();
    }
}
