<?php
namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyTypeCollection;

class CustomerPropertyTypesController extends Controller
{
    public function index(
        Request $request,
        Customer $customer
    ): PropertyTypeCollection {
        $this->authorize('view', $customer);

        $search = $request->get('search', '');

        $propertyTypes = $customer
            ->propertyTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new PropertyTypeCollection($propertyTypes);
    }

    public function store(
        Request $request,
        Customer $customer,
        PropertyType $propertyType
    ): Response {
        $this->authorize('update', $customer);

        $customer->propertyTypes()->syncWithoutDetaching([$propertyType->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Customer $customer,
        PropertyType $propertyType
    ): Response {
        $this->authorize('update', $customer);

        $customer->propertyTypes()->detach($propertyType);

        return response()->noContent();
    }
}
