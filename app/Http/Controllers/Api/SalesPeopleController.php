<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleResource;
use App\Http\Resources\SalesPeopleCollection;
use App\Http\Requests\SalesPeopleStoreRequest;
use App\Http\Requests\SalesPeopleUpdateRequest;

class SalesPeopleController extends Controller
{
    public function index(Request $request): SalesPeopleCollection
    {
        $this->authorize('view-any', SalesPeople::class);

        $search = $request->get('search', '');

        $allSalesPeople = SalesPeople::search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleCollection($allSalesPeople);
    }

    public function store(SalesPeopleStoreRequest $request): SalesPeopleResource
    {
        $this->authorize('create', SalesPeople::class);

        $validated = $request->validated();

        $salesPeople = SalesPeople::create($validated);

        return new SalesPeopleResource($salesPeople);
    }

    public function show(
        Request $request,
        SalesPeople $salesPeople
    ): SalesPeopleResource {
        $this->authorize('view', $salesPeople);

        return new SalesPeopleResource($salesPeople);
    }

    public function update(
        SalesPeopleUpdateRequest $request,
        SalesPeople $salesPeople
    ): SalesPeopleResource {
        $this->authorize('update', $salesPeople);

        $validated = $request->validated();

        $salesPeople->update($validated);

        return new SalesPeopleResource($salesPeople);
    }

    public function destroy(
        Request $request,
        SalesPeople $salesPeople
    ): Response {
        $this->authorize('delete', $salesPeople);

        $salesPeople->delete();

        return response()->noContent();
    }
}
