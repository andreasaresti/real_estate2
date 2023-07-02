<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\FavoriteProperty;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FavoritePropertyStoreRequest;
use App\Http\Requests\FavoritePropertyUpdateRequest;

class FavoritePropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', FavoriteProperty::class);

        $search = $request->get('search', '');

        $favoriteProperties = FavoriteProperty::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.favorite_properties.index',
            compact('favoriteProperties', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', FavoriteProperty::class);

        $customers = Customer::pluck('name', 'id');
        $listings = Listing::pluck('name', 'id');

        return view(
            'app.favorite_properties.create',
            compact('customers', 'listings')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        FavoritePropertyStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', FavoriteProperty::class);

        $validated = $request->validated();

        $favoriteProperty = FavoriteProperty::create($validated);

        return redirect()
            ->route('favorite-properties.edit', $favoriteProperty)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        FavoriteProperty $favoriteProperty
    ): View {
        $this->authorize('view', $favoriteProperty);

        return view(
            'app.favorite_properties.show',
            compact('favoriteProperty')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        FavoriteProperty $favoriteProperty
    ): View {
        $this->authorize('update', $favoriteProperty);

        $customers = Customer::pluck('name', 'id');
        $listings = Listing::pluck('name', 'id');

        return view(
            'app.favorite_properties.edit',
            compact('favoriteProperty', 'customers', 'listings')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FavoritePropertyUpdateRequest $request,
        FavoriteProperty $favoriteProperty
    ): RedirectResponse {
        $this->authorize('update', $favoriteProperty);

        $validated = $request->validated();

        $favoriteProperty->update($validated);

        return redirect()
            ->route('favorite-properties.edit', $favoriteProperty)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        FavoriteProperty $favoriteProperty
    ): RedirectResponse {
        $this->authorize('delete', $favoriteProperty);

        $favoriteProperty->delete();

        return redirect()
            ->route('favorite-properties.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
