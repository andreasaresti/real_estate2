<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerRole;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerRoleResource;
use App\Http\Resources\CustomerRoleCollection;
use App\Http\Requests\CustomerRoleStoreRequest;
use App\Http\Requests\CustomerRoleUpdateRequest;

class CustomerRoleController extends Controller
{
    public function index(Request $request): CustomerRoleCollection
    {
        $this->authorize('view-any', CustomerRole::class);

        $search = $request->get('search', '');

        $customerRoles = CustomerRole::search($search)
            ->latest()
            ->paginate();

        return new CustomerRoleCollection($customerRoles);
    }

    public function store(
        CustomerRoleStoreRequest $request
    ): CustomerRoleResource {
        $this->authorize('create', CustomerRole::class);

        $validated = $request->validated();

        $customerRole = CustomerRole::create($validated);

        return new CustomerRoleResource($customerRole);
    }

    public function show(
        Request $request,
        CustomerRole $customerRole
    ): CustomerRoleResource {
        $this->authorize('view', $customerRole);

        return new CustomerRoleResource($customerRole);
    }

    public function update(
        CustomerRoleUpdateRequest $request,
        CustomerRole $customerRole
    ): CustomerRoleResource {
        $this->authorize('update', $customerRole);

        $validated = $request->validated();

        $customerRole->update($validated);

        return new CustomerRoleResource($customerRole);
    }

    public function destroy(
        Request $request,
        CustomerRole $customerRole
    ): Response {
        $this->authorize('delete', $customerRole);

        $customerRole->delete();

        return response()->noContent();
    }
}
