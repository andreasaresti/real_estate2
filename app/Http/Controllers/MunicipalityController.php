<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\View\View;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MunicipalityStoreRequest;
use App\Http\Requests\MunicipalityUpdateRequest;

class MunicipalityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Municipality::class);

        $search = $request->get('search', '');

        $municipalities = Municipality::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.municipalities.index',
            compact('municipalities', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Municipality::class);

        $districts = District::pluck('name', 'id');

        return view('app.municipalities.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MunicipalityStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Municipality::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $municipality = Municipality::create($validated);

        return redirect()
            ->route('municipalities.edit', $municipality)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Municipality $municipality): View
    {
        $this->authorize('view', $municipality);

        return view('app.municipalities.show', compact('municipality'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Municipality $municipality): View
    {
        $this->authorize('update', $municipality);

        $districts = District::pluck('name', 'id');

        return view(
            'app.municipalities.edit',
            compact('municipality', 'districts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        MunicipalityUpdateRequest $request,
        Municipality $municipality
    ): RedirectResponse {
        $this->authorize('update', $municipality);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $municipality->update($validated);

        return redirect()
            ->route('municipalities.edit', $municipality)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Municipality $municipality
    ): RedirectResponse {
        $this->authorize('delete', $municipality);

        $municipality->delete();

        return redirect()
            ->route('municipalities.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
