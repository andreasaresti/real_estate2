<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ListingAttachment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ListingAttachmentResource;
use App\Http\Resources\ListingAttachmentCollection;
use App\Http\Requests\ListingAttachmentStoreRequest;
use App\Http\Requests\ListingAttachmentUpdateRequest;

class ListingAttachmentController extends Controller
{
    public function index(Request $request): ListingAttachmentCollection
    {
        $this->authorize('view-any', ListingAttachment::class);

        $search = $request->get('search', '');

        $listingAttachments = ListingAttachment::search($search)
            ->latest()
            ->paginate();

        return new ListingAttachmentCollection($listingAttachments);
    }

    public function store(
        ListingAttachmentStoreRequest $request
    ): ListingAttachmentResource {
        $this->authorize('create', ListingAttachment::class);

        $validated = $request->validated();
        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request
                ->file('attachment')
                ->store('public');
        }

        $listingAttachment = ListingAttachment::create($validated);

        return new ListingAttachmentResource($listingAttachment);
    }

    public function show(
        Request $request,
        ListingAttachment $listingAttachment
    ): ListingAttachmentResource {
        $this->authorize('view', $listingAttachment);

        return new ListingAttachmentResource($listingAttachment);
    }

    public function update(
        ListingAttachmentUpdateRequest $request,
        ListingAttachment $listingAttachment
    ): ListingAttachmentResource {
        $this->authorize('update', $listingAttachment);

        $validated = $request->validated();

        if ($request->hasFile('attachment')) {
            if ($listingAttachment->attachment) {
                Storage::delete($listingAttachment->attachment);
            }

            $validated['attachment'] = $request
                ->file('attachment')
                ->store('public');
        }

        $listingAttachment->update($validated);

        return new ListingAttachmentResource($listingAttachment);
    }

    public function destroy(
        Request $request,
        ListingAttachment $listingAttachment
    ): Response {
        $this->authorize('delete', $listingAttachment);

        if ($listingAttachment->attachment) {
            Storage::delete($listingAttachment->attachment);
        }

        $listingAttachment->delete();

        return response()->noContent();
    }
}
