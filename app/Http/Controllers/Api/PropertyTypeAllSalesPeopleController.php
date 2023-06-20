<?php
namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesPeopleCollection;

class PropertyTypeAllSalesPeopleController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): SalesPeopleCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $allSalesPeople = $propertyType
            ->allSalesPeople()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesPeopleCollection($allSalesPeople);
    }

    public function store(
        Request $request,
        PropertyType $propertyType,
        SalesPeople $salesPeople
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType
            ->allSalesPeople()
            ->syncWithoutDetaching([$salesPeople->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        PropertyType $propertyType,
        SalesPeople $salesPeople
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType->allSalesPeople()->detach($salesPeople);

        return response()->noContent();
    }
}
