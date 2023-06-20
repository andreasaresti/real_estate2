<?php

namespace App\Http\Controllers\Api;

use App\Models\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\MarketplaceResource;
use App\Http\Resources\MarketplaceCollection;
use App\Http\Requests\MarketplaceStoreRequest;
use App\Http\Requests\MarketplaceUpdateRequest;

class MarketplaceController extends Controller
{
    public function index(Request $request): MarketplaceCollection
    {
        $this->authorize('view-any', Marketplace::class);

        $search = $request->get('search', '');

        $marketplaces = Marketplace::search($search)
            ->latest()
            ->paginate();

        return new MarketplaceCollection($marketplaces);
    }

    public function store(MarketplaceStoreRequest $request): MarketplaceResource
    {
        $this->authorize('create', Marketplace::class);

        $validated = $request->validated();

        $marketplace = Marketplace::create($validated);

        return new MarketplaceResource($marketplace);
    }

    public function show(
        Request $request,
        Marketplace $marketplace
    ): MarketplaceResource {
        $this->authorize('view', $marketplace);

        return new MarketplaceResource($marketplace);
    }

    public function update(
        MarketplaceUpdateRequest $request,
        Marketplace $marketplace
    ): MarketplaceResource {
        $this->authorize('update', $marketplace);

        $validated = $request->validated();

        $marketplace->update($validated);

        return new MarketplaceResource($marketplace);
    }

    public function destroy(
        Request $request,
        Marketplace $marketplace
    ): Response {
        $this->authorize('delete', $marketplace);

        $marketplace->delete();

        return response()->noContent();
    }
}
