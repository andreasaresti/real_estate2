<?php
namespace App\Http\Controllers\Api;

use App\Models\SalesPeople;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyTypeCollection;

class SalesPeoplePropertyTypesController extends Controller
{
    public function index(
        Request $request,
        SalesPeople $salesPeople
    ): PropertyTypeCollection {
        $this->authorize('view', $salesPeople);

        $search = $request->get('search', '');

        $propertyTypes = $salesPeople
            ->propertyTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new PropertyTypeCollection($propertyTypes);
    }

    public function store(
        Request $request,
        SalesPeople $salesPeople,
        PropertyType $propertyType
    ): Response {
        $this->authorize('update', $salesPeople);

        $salesPeople
            ->propertyTypes()
            ->syncWithoutDetaching([$propertyType->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        SalesPeople $salesPeople,
        PropertyType $propertyType
    ): Response {
        $this->authorize('update', $salesPeople);

        $salesPeople->propertyTypes()->detach($propertyType);

        return response()->noContent();
    }
}
