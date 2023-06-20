<?php

namespace App\Http\Controllers\Api;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestResource;
use App\Http\Resources\SalesRequestCollection;

class PropertyTypeSalesRequestsController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): SalesRequestCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $salesRequests = $propertyType
            ->salesRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestCollection($salesRequests);
    }

    public function store(
        Request $request,
        PropertyType $propertyType
    ): SalesRequestResource {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'source_id' => ['required', 'exists:sources,id'],
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
            'minimum_budget' => ['nullable', 'numeric'],
            'maximum_budget' => ['nullable', 'numeric'],
            'description' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesRequest = $propertyType->salesRequests()->create($validated);

        return new SalesRequestResource($salesRequest);
    }
}
