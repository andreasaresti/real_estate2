<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FeatureStoreRequest;
use App\Http\Requests\FeatureUpdateRequest;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Feature::class);

        $search = $request->get('search', '');

        $features = Feature::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.features.index', compact('features', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Feature::class);

        return view('app.features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FeatureStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Feature::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $feature = Feature::create($validated);

        return redirect()
            ->route('features.edit', $feature)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Feature $feature): View
    {
        $this->authorize('view', $feature);

        return view('app.features.show', compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Feature $feature): View
    {
        $this->authorize('update', $feature);

        return view('app.features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FeatureUpdateRequest $request,
        Feature $feature
    ): RedirectResponse {
        $this->authorize('update', $feature);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($feature->image) {
                Storage::delete($feature->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $feature->update($validated);

        return redirect()
            ->route('features.edit', $feature)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Feature $feature
    ): RedirectResponse {
        $this->authorize('delete', $feature);

        if ($feature->image) {
            Storage::delete($feature->image);
        }

        $feature->delete();

        return redirect()
            ->route('features.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
