<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MarketplaceStoreRequest;
use App\Http\Requests\MarketplaceUpdateRequest;

class MarketplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Marketplace::class);

        $search = $request->get('search', '');

        $marketplaces = Marketplace::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.marketplaces.index',
            compact('marketplaces', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Marketplace::class);

        return view('app.marketplaces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MarketplaceStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Marketplace::class);

        $validated = $request->validated();

        $marketplace = Marketplace::create($validated);

        return redirect()
            ->route('marketplaces.edit', $marketplace)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Marketplace $marketplace): View
    {
        $this->authorize('view', $marketplace);

        return view('app.marketplaces.show', compact('marketplace'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Marketplace $marketplace): View
    {
        $this->authorize('update', $marketplace);

        return view('app.marketplaces.edit', compact('marketplace'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MarketplaceUpdateRequest $request,
        Marketplace $marketplace
    ): RedirectResponse {
        $this->authorize('update', $marketplace);

        $validated = $request->validated();

        $marketplace->update($validated);

        return redirect()
            ->route('marketplaces.edit', $marketplace)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Marketplace $marketplace
    ): RedirectResponse {
        $this->authorize('delete', $marketplace);

        $marketplace->delete();

        return redirect()
            ->route('marketplaces.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
