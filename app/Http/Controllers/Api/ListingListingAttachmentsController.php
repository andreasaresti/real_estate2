<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingAttachmentResource;
use App\Http\Resources\ListingAttachmentCollection;

class ListingListingAttachmentsController extends Controller
{
    public function index(
        Request $request,
        Listing $listing
    ): ListingAttachmentCollection {
        $this->authorize('view', $listing);

        $search = $request->get('search', '');

        $listingAttachments = $listing
            ->listingAttachments()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingAttachmentCollection($listingAttachments);
    }

    public function store(
        Request $request,
        Listing $listing
    ): ListingAttachmentResource {
        $this->authorize('create', ListingAttachment::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'attachment' => ['file', 'max:1024', 'required'],
        ]);

        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request
                ->file('attachment')
                ->store('public');
        }

        $listingAttachment = $listing->listingAttachments()->create($validated);

        return new ListingAttachmentResource($listingAttachment);
    }
}
