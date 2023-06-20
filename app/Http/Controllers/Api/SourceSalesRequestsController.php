<?php

namespace App\Http\Controllers\Api;

use App\Models\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestResource;
use App\Http\Resources\SalesRequestCollection;

class SourceSalesRequestsController extends Controller
{
    public function index(
        Request $request,
        Source $source
    ): SalesRequestCollection {
        $this->authorize('view', $source);

        $search = $request->get('search', '');

        $salesRequests = $source
            ->salesRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestCollection($salesRequests);
    }

    public function store(
        Request $request,
        Source $source
    ): SalesRequestResource {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'minimum_budget' => ['nullable', 'numeric'],
            'maximum_budget' => ['nullable', 'numeric'],
            'description' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesRequest = $source->salesRequests()->create($validated);

        return new SalesRequestResource($salesRequest);
    }
}
