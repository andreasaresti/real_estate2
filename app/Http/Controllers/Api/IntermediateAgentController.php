<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\IntermediateAgent;
use App\Http\Controllers\Controller;
use App\Http\Resources\IntermediateAgentResource;
use App\Http\Resources\IntermediateAgentCollection;
use App\Http\Requests\IntermediateAgentStoreRequest;
use App\Http\Requests\IntermediateAgentUpdateRequest;

class IntermediateAgentController extends Controller
{
    public function index(Request $request): IntermediateAgentCollection
    {
        $this->authorize('view-any', IntermediateAgent::class);

        $search = $request->get('search', '');

        $intermediateAgents = IntermediateAgent::search($search)
            ->latest()
            ->paginate();

        return new IntermediateAgentCollection($intermediateAgents);
    }

    public function store(
        IntermediateAgentStoreRequest $request
    ): IntermediateAgentResource {
        $this->authorize('create', IntermediateAgent::class);

        $validated = $request->validated();

        $intermediateAgent = IntermediateAgent::create($validated);

        return new IntermediateAgentResource($intermediateAgent);
    }

    public function show(
        Request $request,
        IntermediateAgent $intermediateAgent
    ): IntermediateAgentResource {
        $this->authorize('view', $intermediateAgent);

        return new IntermediateAgentResource($intermediateAgent);
    }

    public function update(
        IntermediateAgentUpdateRequest $request,
        IntermediateAgent $intermediateAgent
    ): IntermediateAgentResource {
        $this->authorize('update', $intermediateAgent);

        $validated = $request->validated();

        $intermediateAgent->update($validated);

        return new IntermediateAgentResource($intermediateAgent);
    }

    public function destroy(
        Request $request,
        IntermediateAgent $intermediateAgent
    ): Response {
        $this->authorize('delete', $intermediateAgent);

        $intermediateAgent->delete();

        return response()->noContent();
    }
}
