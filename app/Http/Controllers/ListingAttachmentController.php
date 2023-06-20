<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ListingAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ListingAttachmentStoreRequest;
use App\Http\Requests\ListingAttachmentUpdateRequest;

class ListingAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ListingAttachment::class);

        $search = $request->get('search', '');

        $listingAttachments = ListingAttachment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.listing_attachments.index',
            compact('listingAttachments', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ListingAttachment::class);

        $listings = Listing::pluck('name', 'id');

        return view('app.listing_attachments.create', compact('listings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        ListingAttachmentStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', ListingAttachment::class);

        $validated = $request->validated();
        if ($request->hasFile('attachment')) {
            $validated['attachment'] = $request
                ->file('attachment')
                ->store('public');
        }

        $listingAttachment = ListingAttachment::create($validated);

        return redirect()
            ->route('listing-attachments.edit', $listingAttachment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        ListingAttachment $listingAttachment
    ): View {
        $this->authorize('view', $listingAttachment);

        return view(
            'app.listing_attachments.show',
            compact('listingAttachment')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        ListingAttachment $listingAttachment
    ): View {
        $this->authorize('update', $listingAttachment);

        $listings = Listing::pluck('name', 'id');

        return view(
            'app.listing_attachments.edit',
            compact('listingAttachment', 'listings')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ListingAttachmentUpdateRequest $request,
        ListingAttachment $listingAttachment
    ): RedirectResponse {
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

        return redirect()
            ->route('listing-attachments.edit', $listingAttachment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ListingAttachment $listingAttachment
    ): RedirectResponse {
        $this->authorize('delete', $listingAttachment);

        if ($listingAttachment->attachment) {
            Storage::delete($listingAttachment->attachment);
        }

        $listingAttachment->delete();

        return redirect()
            ->route('listing-attachments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
