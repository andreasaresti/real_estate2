<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DeliveryTimeStoreRequest;
use App\Http\Requests\DeliveryTimeUpdateRequest;

class DeliveryTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DeliveryTime::class);

        $search = $request->get('search', '');

        $deliveryTimes = DeliveryTime::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.delivery_times.index',
            compact('deliveryTimes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DeliveryTime::class);

        return view('app.delivery_times.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DeliveryTimeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', DeliveryTime::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $deliveryTime = DeliveryTime::create($validated);

        return redirect()
            ->route('delivery-times.edit', $deliveryTime)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, DeliveryTime $deliveryTime): View
    {
        $this->authorize('view', $deliveryTime);

        return view('app.delivery_times.show', compact('deliveryTime'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, DeliveryTime $deliveryTime): View
    {
        $this->authorize('update', $deliveryTime);

        return view('app.delivery_times.edit', compact('deliveryTime'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DeliveryTimeUpdateRequest $request,
        DeliveryTime $deliveryTime
    ): RedirectResponse {
        $this->authorize('update', $deliveryTime);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($deliveryTime->image) {
                Storage::delete($deliveryTime->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $deliveryTime->update($validated);

        return redirect()
            ->route('delivery-times.edit', $deliveryTime)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DeliveryTime $deliveryTime
    ): RedirectResponse {
        $this->authorize('delete', $deliveryTime);

        if ($deliveryTime->image) {
            Storage::delete($deliveryTime->image);
        }

        $deliveryTime->delete();

        return redirect()
            ->route('delivery-times.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
