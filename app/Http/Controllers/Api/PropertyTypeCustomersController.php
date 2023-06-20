<?php
namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;

class PropertyTypeCustomersController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): CustomerCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $customers = $propertyType
            ->customers()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerCollection($customers);
    }

    public function store(
        Request $request,
        PropertyType $propertyType,
        Customer $customer
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType->customers()->syncWithoutDetaching([$customer->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        PropertyType $propertyType,
        Customer $customer
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType->customers()->detach($customer);

        return response()->noContent();
    }
}
