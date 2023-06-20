<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleResource;
use App\Http\Resources\SalesPeopleCollection;

class CustomerAllSalesPeopleController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): SalesPeopleCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $allSalesPeople = $customer
            ->allSalesPeople()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleCollection($allSalesPeople);
    }

    public function store(
        Request $request,
        Customer $customer
    ): SalesPeopleResource {
        $this->authorize('create', SalesPeople::class);

        $validated = $request->validate([
            'agent_id' => ['required', 'exists:agents,id'],
            'name' => ['required', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesPeople = $customer->allSalesPeople()->create($validated);

        return new SalesPeopleResource($salesPeople);
    }
}
