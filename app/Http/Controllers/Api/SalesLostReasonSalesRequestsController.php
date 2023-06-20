<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SalesLostReason;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestResource;
use App\Http\Resources\SalesRequestCollection;

class SalesLostReasonSalesRequestsController extends Controller
{
    public function index(
        Request $request,
        SalesLostReason $salesLostReason
    ): SalesRequestCollection {
        $this->authorize('view', $salesLostReason);

        $search = $request->get('search', '');

        $salesRequests = $salesLostReason
            ->salesRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestCollection($salesRequests);
    }

    public function store(
        Request $request,
        SalesLostReason $salesLostReason
    ): SalesRequestResource {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'source_id' => ['required', 'exists:sources,id'],
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'minimum_budget' => ['nullable', 'numeric'],
            'maximum_budget' => ['nullable', 'numeric'],
            'description' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesRequest = $salesLostReason->salesRequests()->create($validated);

        return new SalesRequestResource($salesRequest);
    }
}
