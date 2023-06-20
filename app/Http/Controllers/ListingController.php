<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Listing;
use App\Models\Location;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\DeliveryTime;
use App\Models\InternalStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ListingStoreRequest;
use App\Http\Requests\ListingUpdateRequest;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Listing::class);

        $search = $request->get('search', '');

        $listings = Listing::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.listings.index', compact('listings', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Listing::class);

        $listings = Listing::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');
        $statuses = Status::pluck('name', 'id');
        $deliveryTimes = DeliveryTime::pluck('name', 'id');
        $internalStatuses = InternalStatus::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');

        return view(
            'app.listings.create',
            compact(
                'listings',
                'locations',
                'statuses',
                'deliveryTimes',
                'internalStatuses',
                'customers'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListingStoreRequest $request): RedirectResponse
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

        return redirect()
            ->route('listings.edit', $listing)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Listing $listing): View
    {
        $this->authorize('view', $listing);

        return view('app.listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Listing $listing): View
    {
        $this->authorize('update', $listing);

        $listings = Listing::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');
        $statuses = Status::pluck('name', 'id');
        $deliveryTimes = DeliveryTime::pluck('name', 'id');
        $internalStatuses = InternalStatus::pluck('name', 'id');
        $customers = Customer::pluck('name', 'id');

        return view(
            'app.listings.edit',
            compact(
                'listing',
                'listings',
                'locations',
                'statuses',
                'deliveryTimes',
                'internalStatuses',
                'customers'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ListingUpdateRequest $request,
        Listing $listing
    ): RedirectResponse {
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

        return redirect()
            ->route('listings.edit', $listing)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Listing $listing
    ): RedirectResponse {
        $this->authorize('delete', $listing);

        if ($listing->image) {
            Storage::delete($listing->image);
        }

        $listing->delete();

        return redirect()
            ->route('listings.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
