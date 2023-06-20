<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentResource;
use App\Http\Resources\AgentCollection;

class DistrictAgentsController extends Controller
{
    public function index(Request $request, District $district): AgentCollection
    {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $agents = $district
            ->agents()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgentCollection($agents);
    }

    public function store(Request $request, District $district): AgentResource
    {
        $this->authorize('create', Agent::class);

        $validated = $request->validate([
            'ext_code' => [
                'nullable',
                'unique:agents,ext_code',
                'max:255',
                'string',
            ],
            'name' => ['required', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'address' => ['nullable', 'max:255', 'string'],
            'postal_code' => ['nullable', 'max:255', 'string'],
            'city' => ['nullable', 'max:255', 'string'],
            'country' => ['nullable', 'max:255', 'string'],
            'comments' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $agent = $district->agents()->create($validated);

        return new AgentResource($agent);
    }
}
