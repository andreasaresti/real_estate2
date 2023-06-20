<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritePropertyResource;
use App\Http\Resources\FavoritePropertyCollection;

class ListingFavoritePropertiesController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): FavoritePropertyCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $favoriteProperties = $listing
            ->favoriteProperties()
            ->search($search)
            ->latest()
            ->paginate();

        return new FavoritePropertyCollection($favoriteProperties);
    }

    public function store(
        Request $request,
        Listing $listing
    ): FavoritePropertyResource {
        $this->authorize('create', FavoriteProperty::class);

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
        ]);

        $favoriteProperty = $listing->favoriteProperties()->create($validated);

        return new FavoritePropertyResource($favoriteProperty);
    }
}
