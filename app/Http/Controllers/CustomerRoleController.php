<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\CustomerRole;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CustomerRoleStoreRequest;
use App\Http\Requests\CustomerRoleUpdateRequest;

class CustomerRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', CustomerRole::class);

        $search = $request->get('search', '');

        $customerRoles = CustomerRole::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.customer_roles.index',
            compact('customerRoles', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', CustomerRole::class);

        return view('app.customer_roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRoleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', CustomerRole::class);

        $validated = $request->validated();

        $customerRole = CustomerRole::create($validated);

        return redirect()
            ->route('customer-roles.edit', $customerRole)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, CustomerRole $customerRole): View
    {
        $this->authorize('view', $customerRole);

        return view('app.customer_roles.show', compact('customerRole'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, CustomerRole $customerRole): View
    {
        $this->authorize('update', $customerRole);

        return view('app.customer_roles.edit', compact('customerRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CustomerRoleUpdateRequest $request,
        CustomerRole $customerRole
    ): RedirectResponse {
        $this->authorize('update', $customerRole);

        $validated = $request->validated();

        $customerRole->update($validated);

        return redirect()
            ->route('customer-roles.edit', $customerRole)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        CustomerRole $customerRole
    ): RedirectResponse {
        $this->authorize('delete', $customerRole);

        $customerRole->delete();

        return redirect()
            ->route('customer-roles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
