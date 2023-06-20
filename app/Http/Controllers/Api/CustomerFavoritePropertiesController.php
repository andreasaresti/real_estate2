<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritePropertyResource;
use App\Http\Resources\FavoritePropertyCollection;

class CustomerFavoritePropertiesController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): FavoritePropertyCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $favoriteProperties = $customer
            ->favoriteProperties()
            ->search($search)
            ->latest()
            ->paginate();

        return new FavoritePropertyCollection($favoriteProperties);
    }

    public function store(
        Request $request,
        Customer $customer
    ): FavoritePropertyResource {
        $this->authorize('create', FavoriteProperty::class);

        $validated = $request->validate([
            'listing_id' => ['required', 'exists:listings,id'],
        ]);

        $favoriteProperty = $customer->favoriteProperties()->create($validated);

        return new FavoritePropertyResource($favoriteProperty);
    }
}
