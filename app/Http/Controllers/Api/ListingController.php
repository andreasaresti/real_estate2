<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ListingCollection;
use App\Http\Requests\ListingStoreRequest;
use App\Http\Requests\ListingUpdateRequest;

class ListingController extends Controller
{
    public function index(Request $request): ListingCollection
    {
        $this->authorize('view-any', Listing::class);

        $search = $request->get('search', '');

        $listings = Listing::search($search)
            ->latest()
            ->paginate();

        return new ListingCollection($listings);
    }

    public function store(ListingStoreRequest $request): ListingResource
    {
        $this->authorize('create', Listing::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $listing = Listing::create($validated);

        return new ListingResource($listing);
    }

    public function show(Request $request, Listing $listing): ListingResource
    {
        $this->authorize('view', $listing);

        return new ListingResource($listing);
    }

    public function update(
        ListingUpdateRequest $request,
        Listing $listing
    ): ListingResource {
        $this->authorize('update', $listing);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($listing->image) {
                Storage::delete($listing->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $listing->update($validated);

        return new ListingResource($listing);
    }

    public function destroy(Request $request, Listing $listing): Response
    {
        $this->authorize('delete', $listing);

        if ($listing->image) {
            Storage::delete($listing->image);
        }

        $listing->delete();

        return response()->noContent();
    }
}
