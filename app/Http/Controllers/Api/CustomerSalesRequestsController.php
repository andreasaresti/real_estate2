<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestResource;
use App\Http\Resources\SalesRequestCollection;

class CustomerSalesRequestsController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): SalesRequestCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $salesRequests = $customer
            ->salesRequests()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestCollection($salesRequests);
    }

    public function store(
        Request $request,
        Customer $customer
    ): SalesRequestResource {
        $this->authorize('create', SalesRequest::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'date' => ['required', 'date'],
            'source_id' => ['required', 'exists:sources,id'],
            'sales_people_id' => ['nullable', 'exists:sales_people,id'],
            'property_type_id' => ['required', 'exists:property_types,id'],
            'minimum_budget' => ['nullable', 'numeric'],
            'maximum_budget' => ['nullable', 'numeric'],
            'description' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesRequest = $customer->salesRequests()->create($validated);

        return new SalesRequestResource($salesRequest);
    }
}
