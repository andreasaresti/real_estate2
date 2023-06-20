<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\ListingAdditionalDetail;
use App\Http\Resources\ListingAdditionalDetailResource;
use App\Http\Resources\ListingAdditionalDetailCollection;
use App\Http\Requests\ListingAdditionalDetailStoreRequest;
use App\Http\Requests\ListingAdditionalDetailUpdateRequest;

class ListingAdditionalDetailController extends Controller
{
    public function index(Request $request): ListingAdditionalDetailCollection
    {
        $this->authorize('view-any', ListingAdditionalDetail::class);

        $search = $request->get('search', '');

        $listingAdditionalDetails = ListingAdditionalDetail::search($search)
            ->latest()
            ->paginate();

        return new ListingAdditionalDetailCollection($listingAdditionalDetails);
    }

    public function store(
        ListingAdditionalDetailStoreRequest $request
    ): ListingAdditionalDetailResource {
        $this->authorize('create', ListingAdditionalDetail::class);

        $validated = $request->validated();
        $validated['title'] = json_decode($validated['title'], true);

        $validated['value'] = json_decode($validated['value'], true);

        $listingAdditionalDetail = ListingAdditionalDetail::create($validated);

        return new ListingAdditionalDetailResource($listingAdditionalDetail);
    }

    public function show(
        Request $request,
        ListingAdditionalDetail $listingAdditionalDetail
    ): ListingAdditionalDetailResource {
        $this->authorize('view', $listingAdditionalDetail);

        return new ListingAdditionalDetailResource($listingAdditionalDetail);
    }

    public function update(
        ListingAdditionalDetailUpdateRequest $request,
        ListingAdditionalDetail $listingAdditionalDetail
    ): ListingAdditionalDetailResource {
        $this->authorize('update', $listingAdditionalDetail);

        $validated = $request->validated();

        $validated['title'] = json_decode($validated['title'], true);

        $validated['value'] = json_decode($validated['value'], true);

        $listingAdditionalDetail->update($validated);

        return new ListingAdditionalDetailResource($listingAdditionalDetail);
    }

    public function destroy(
        Request $request,
        ListingAdditionalDetail $listingAdditionalDetail
    ): Response {
        $this->authorize('delete', $listingAdditionalDetail);

        $listingAdditionalDetail->delete();

        return response()->noContent();
    }
}
