<?php

namespace App\Http\Controllers\Api;

use App\Models\ListingType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ListingTypeResource;
use App\Http\Resources\ListingTypeCollection;
use App\Http\Requests\ListingTypeStoreRequest;
use App\Http\Requests\ListingTypeUpdateRequest;

class ListingTypeController extends Controller
{
    public function index(Request $request): ListingTypeCollection
    {
        $this->authorize('view-any', ListingType::class);

        $search = $request->get('search', '');

        $listingTypes = ListingType::search($search)
            ->latest()
            ->paginate();

        return new ListingTypeCollection($listingTypes);
    }

    public function store(ListingTypeStoreRequest $request): ListingTypeResource
    {
        $this->authorize('create', ListingType::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $listingType = ListingType::create($validated);

        return new ListingTypeResource($listingType);
    }

    public function show(
        Request $request,
        ListingType $listingType
    ): ListingTypeResource {
        $this->authorize('view', $listingType);

        return new ListingTypeResource($listingType);
    }

    public function update(
        ListingTypeUpdateRequest $request,
        ListingType $listingType
    ): ListingTypeResource {
        $this->authorize('update', $listingType);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($listingType->image) {
                Storage::delete($listingType->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $listingType->update($validated);

        return new ListingTypeResource($listingType);
    }

    public function destroy(
        Request $request,
        ListingType $listingType
    ): Response {
        $this->authorize('delete', $listingType);

        if ($listingType->image) {
            Storage::delete($listingType->image);
        }

        $listingType->delete();

        return response()->noContent();
    }
}
