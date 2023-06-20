<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleResource;
use App\Http\Resources\SalesPeopleCollection;

class AgentAllSalesPeopleController extends Controller
{
    public function index(Request $request, Agent $agent): SalesPeopleCollection
    {
        $this->authorize('view', $agent);

        $search = $request->get('search', '');

        $allSalesPeople = $agent
            ->allSalesPeople()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleCollection($allSalesPeople);
    }

    public function store(Request $request, Agent $agent): SalesPeopleResource
    {
        $this->authorize('create', SalesPeople::class);

        $validated = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'name' => ['required', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        $salesPeople = $agent->allSalesPeople()->create($validated);

        return new SalesPeopleResource($salesPeople);
    }
}
