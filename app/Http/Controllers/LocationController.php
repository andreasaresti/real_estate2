<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Municipality;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Location::class);

        $search = $request->get('search', '');

        $locations = Location::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.locations.index', compact('locations', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Location::class);

        $municipalities = Municipality::pluck('name', 'id');

        return view('app.locations.create', compact('municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Location::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $location = Location::create($validated);

        return redirect()
            ->route('locations.edit', $location)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Location $location): View
    {
        $this->authorize('view', $location);

        return view('app.locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Location $location): View
    {
        $this->authorize('update', $location);

        $municipalities = Municipality::pluck('name', 'id');

        return view(
            'app.locations.edit',
            compact('location', 'municipalities')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        LocationUpdateRequest $request,
        Location $location
    ): RedirectResponse {
        $this->authorize('update', $location);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $location->update($validated);

        return redirect()
            ->route('locations.edit', $location)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Location $location
    ): RedirectResponse {
        $this->authorize('delete', $location);

        $location->delete();

        return redirect()
            ->route('locations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
