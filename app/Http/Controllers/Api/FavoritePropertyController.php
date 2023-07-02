<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\FavoriteProperty;
use App\Http\Controllers\Controller;
use App\Http\Resources\FavoritePropertyResource;
use App\Http\Resources\FavoritePropertyCollection;
use App\Http\Requests\FavoritePropertyStoreRequest;
use App\Http\Requests\FavoritePropertyUpdateRequest;

class FavoritePropertyController extends Controller
{
    public function index(Request $request): FavoritePropertyCollection
    {
        $this->authorize('view-any', FavoriteProperty::class);

        $search = $request->get('search', '');

        $favoriteProperties = FavoriteProperty::search($search)
            ->latest()
            ->paginate();

        return new FavoritePropertyCollection($favoriteProperties);
    }

    public function store(
        FavoritePropertyStoreRequest $request
    ): FavoritePropertyResource {
        $this->authorize('create', FavoriteProperty::class);

        $validated = $request->validated();

        $favoriteProperty = FavoriteProperty::create($validated);

        return new FavoritePropertyResource($favoriteProperty);
    }

    public function show(
        Request $request,
        FavoriteProperty $favoriteProperty
    ): FavoritePropertyResource {
        $this->authorize('view', $favoriteProperty);

        return new FavoritePropertyResource($favoriteProperty);
    }

    public function update(
        FavoritePropertyUpdateRequest $request,
        FavoriteProperty $favoriteProperty
    ): FavoritePropertyResource {
        $this->authorize('update', $favoriteProperty);

        $validated = $request->validated();

        $favoriteProperty->update($validated);

        return new FavoritePropertyResource($favoriteProperty);
    }

    public function destroy(
        Request $request,
        FavoriteProperty $favoriteProperty
    ): Response {
        $this->authorize('delete', $favoriteProperty);

        $favoriteProperty->delete();

        return response()->noContent();
    }
}
