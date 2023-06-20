<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentResource;
use App\Http\Resources\AgentCollection;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AgentStoreRequest;
use App\Http\Requests\AgentUpdateRequest;

class AgentController extends Controller
{
    public function index(Request $request): AgentCollection
    {
        $this->authorize('view-any', Agent::class);

        $search = $request->get('search', '');

        $agents = Agent::search($search)
            ->latest()
            ->paginate();

        return new AgentCollection($agents);
    }

    public function store(AgentStoreRequest $request): AgentResource
    {
        $this->authorize('create', Agent::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $agent = Agent::create($validated);

        return new AgentResource($agent);
    }

    public function show(Request $request, Agent $agent): AgentResource
    {
        $this->authorize('view', $agent);

        return new AgentResource($agent);
    }

    public function update(
        AgentUpdateRequest $request,
        Agent $agent
    ): AgentResource {
        $this->authorize('update', $agent);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($agent->image) {
                Storage::delete($agent->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $agent->update($validated);

        return new AgentResource($agent);
    }

    public function destroy(Request $request, Agent $agent): Response
    {
        $this->authorize('delete', $agent);

        if ($agent->image) {
            Storage::delete($agent->image);
        }

        $agent->delete();

        return response()->noContent();
    }
}
