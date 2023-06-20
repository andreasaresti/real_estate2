<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingAdditionalDetailResource;
use App\Http\Resources\ListingAdditionalDetailCollection;

class ListingListingAdditionalDetailsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): ListingAdditionalDetailCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $listingAdditionalDetails = $listing
            ->listingAdditionalDetails()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingAdditionalDetailCollection($listingAdditionalDetails);
    }

    public function store(
        Request $request,
        Listing $listing
    ): ListingAdditionalDetailResource {
        $this->authorize('create', ListingAdditionalDetail::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'json'],
            'value' => ['required', 'max:255', 'json'],
            'sequence' => ['required', 'numeric'],
        ]);

        $listingAdditionalDetail = $listing
            ->listingAdditionalDetails()
            ->create($validated);

        return new ListingAdditionalDetailResource($listingAdditionalDetail);
    }
}
