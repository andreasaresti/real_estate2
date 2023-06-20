<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomerRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;

class CustomerRoleCustomersController extends Controller
{
    public function index(
        Request $request,
        CustomerRole $customerRole
    ): CustomerCollection {
        $this->authorize('view', $customerRole);

        $search = $request->get('search', '');

        $customers = $customerRole
            ->customers()
            ->search($search)
            ->latest()
            ->paginate();

        return new CustomerCollection($customers);
    }

    public function store(
        Request $request,
        CustomerRole $customerRole
    ): CustomerResource {
        $this->authorize('create', Customer::class);

        $validated = $request->validate([
            'ext_code' => [
                'nullable',
                'unique:customers,ext_code',
                'max:255',
                'string',
            ],
            'type' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'surname' => ['nullable', 'max:255', 'string'],
            'company_name' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'email' => ['required', 'unique:customers,email', 'email'],
            'password' => ['required'],
            'mobile' => ['nullable', 'max:255', 'string'],
            'phone' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'postal_code' => ['nullable', 'max:255', 'string'],
            'city' => ['nullable', 'max:255', 'string'],
            'district' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string'],
            'notes' => ['nullable', 'max:255', 'string'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $customer = $customerRole->customers()->create($validated);

        return new CustomerResource($customer);
    }
}
