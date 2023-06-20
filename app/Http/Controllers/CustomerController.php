<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\CustomerRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Customer::class);

        $search = $request->get('search', '');

        $customers = Customer::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.customers.index', compact('customers', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Customer::class);

        $customerRoles = CustomerRole::pluck('name', 'id');

        return view('app.customers.create', compact('customerRoles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Customer::class);

        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $customer = Customer::create($validated);

        return redirect()
            ->route('customers.edit', $customer)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Customer $customer): View
    {
        $this->authorize('view', $customer);

        return view('app.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Customer $customer): View
    {
        $this->authorize('update', $customer);

        $customerRoles = CustomerRole::pluck('name', 'id');

        return view('app.customers.edit', compact('customer', 'customerRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CustomerUpdateRequest $request,
        Customer $customer
    ): RedirectResponse {
        $this->authorize('update', $customer);

        $validated = $request->validated();

        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('image')) {
            if ($customer->image) {
                Storage::delete($customer->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $customer->update($validated);

        return redirect()
            ->route('customers.edit', $customer)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Customer $customer
    ): RedirectResponse {
        $this->authorize('delete', $customer);

        if ($customer->image) {
            Storage::delete($customer->image);
        }

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
