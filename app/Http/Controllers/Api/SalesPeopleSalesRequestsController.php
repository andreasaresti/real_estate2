<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestResource;
use App\Http\Resources\SalesRequestCollection;

class SalesPeopleSalesRequestsController extends Controller
{
    public function index(
        Request $request,
        SalesPeople $salesPeople
    ): SalesRequestCollection {
        $this->authorize('view', $salesPeople);

        $search = $request->get('search', '');

        $salesRequests = $salesPeople
            ->salesRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestCollection($salesRequests);
    }

    public function store(
        Request $request,
        SalesPeople $salesPeople
    ): SalesRequestResource {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'customer_id' => ['required', 'exists:customers,id'],
            'source_id' => ['required', 'exists:sources,id'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'minimum_budget' => ['nullable', 'numeric'],
            'maximum_budget' => ['nullable', 'numeric'],
            'description' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesRequest = $salesPeople->salesRequests()->create($validated);

        return new SalesRequestResource($salesRequest);
    }
}
