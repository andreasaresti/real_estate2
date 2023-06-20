<?php

namespace App\Http\Controllers\Api;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListingResource;
use App\Http\Resources\ListingCollection;

class PropertyTypeListingsController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): ListingCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $listings = $propertyType
            ->listings()
            ->search($search)
            ->latest()
            ->paginate();

        return new ListingCollection($listings);
    }

    public function store(
        Request $request,
        PropertyType $propertyType
    ): ListingResource {
        $this->authorize('create', Listing::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'parent_id' => ['nullable', 'exists:listings,id'],
            'description' => ['nullable', 'max:255', 'json'],
            'price' => ['required', 'numeric'],
            'old_price' => ['nullable', 'numeric'],
            'price_prefix' => ['nullable', 'max:255', 'string'],
            'price_postfix' => ['nullable', 'max:255', 'string'],
            'area_size' => ['nullable', 'numeric'],
            'area_size_prefix' => ['nullable', 'max:255', 'string'],
            'area_size_postfix' => ['nullable', 'max:255', 'string'],
            'number_of_bedrooms' => ['nullable', 'numeric'],
            'number_of_bathrooms' => ['nullable', 'numeric'],
            'number_of_garages_or_parkingpaces' => ['nullable', 'numeric'],
            'year_built' => ['nullable', 'numeric'],
            'featured' => ['nullable', 'boolean'],
            'published' => ['required', 'boolean'],
            'address' => ['nullable', 'max:255', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'max:255', 'string'],
            '360_virtual_tour' => ['nullable', 'max:255', 'string'],
            'energy_class' => ['nullable', 'max:255', 'string'],
            'energy_performance' => ['nullable', 'max:255', 'string'],
            'epc_current_rating' => ['nullable', 'max:255', 'string'],
            'epc_potential_rating' => ['nullable', 'max:255', 'string'],
            'taxes' => ['nullable', 'max:255', 'string'],
            'dues' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
            'location_id' => ['required', 'exists:locations,id'],
            'status_id' => ['required', 'exists:statuses,id'],
            'delivery_time_id' => ['required', 'exists:delivery_times,id'],
            'internal_status_id' => ['required', 'exists:internal_statuses,id'],
            'owner_id' => ['required', 'exists:customers,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $listing = $propertyType->listings()->create($validated);

        return new ListingResource($listing);
    }
}
