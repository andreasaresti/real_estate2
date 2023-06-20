<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PropertyTypeStoreRequest;
use App\Http\Requests\PropertyTypeUpdateRequest;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PropertyType::class);

        $search = $request->get('search', '');

        $propertyTypes = PropertyType::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.property_types.index',
            compact('propertyTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PropertyType::class);

        return view('app.property_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyTypeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PropertyType::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $propertyType = PropertyType::create($validated);

        return redirect()
            ->route('property-types.edit', $propertyType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PropertyType $propertyType): View
    {
        $this->authorize('view', $propertyType);

        return view('app.property_types.show', compact('propertyType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PropertyType $propertyType): View
    {
        $this->authorize('update', $propertyType);

        return view('app.property_types.edit', compact('propertyType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PropertyTypeUpdateRequest $request,
        PropertyType $propertyType
    ): RedirectResponse {
        $this->authorize('update', $propertyType);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $propertyType->update($validated);

        return redirect()
            ->route('property-types.edit', $propertyType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PropertyType $propertyType
    ): RedirectResponse {
        $this->authorize('delete', $propertyType);

        $propertyType->delete();

        return redirect()
            ->route('property-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
