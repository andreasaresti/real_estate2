<?php

namespace App\Http\Controllers\Api;

use App\Models\DeliveryTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DeliveryTimeResource;
use App\Http\Resources\DeliveryTimeCollection;
use App\Http\Requests\DeliveryTimeStoreRequest;
use App\Http\Requests\DeliveryTimeUpdateRequest;

class DeliveryTimeController extends Controller
{
    public function index(Request $request): DeliveryTimeCollection
    {
        $this->authorize('view-any', DeliveryTime::class);

        $search = $request->get('search', '');

        $deliveryTimes = DeliveryTime::search($search)
            ->latest()
            ->paginate();

        return new DeliveryTimeCollection($deliveryTimes);
    }

    public function store(
        DeliveryTimeStoreRequest $request
    ): DeliveryTimeResource {
        $this->authorize('create', DeliveryTime::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $deliveryTime = DeliveryTime::create($validated);

        return new DeliveryTimeResource($deliveryTime);
    }

    public function show(
        Request $request,
        DeliveryTime $deliveryTime
    ): DeliveryTimeResource {
        $this->authorize('view', $deliveryTime);

        return new DeliveryTimeResource($deliveryTime);
    }

    public function update(
        DeliveryTimeUpdateRequest $request,
        DeliveryTime $deliveryTime
    ): DeliveryTimeResource {
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

        return new DeliveryTimeResource($deliveryTime);
    }

    public function destroy(
        Request $request,
        DeliveryTime $deliveryTime
    ): Response {
        $this->authorize('delete', $deliveryTime);

        if ($deliveryTime->image) {
            Storage::delete($deliveryTime->image);
        }

        $deliveryTime->delete();

        return response()->noContent();
    }
}
