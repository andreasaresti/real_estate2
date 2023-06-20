<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\AgentAgreement;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentAgreementResource;
use App\Http\Resources\AgentAgreementCollection;
use App\Http\Requests\AgentAgreementStoreRequest;
use App\Http\Requests\AgentAgreementUpdateRequest;

class AgentAgreementController extends Controller
{
    public function index(Request $request): AgentAgreementCollection
    {
        $this->authorize('view-any', AgentAgreement::class);

        $search = $request->get('search', '');

        $agentAgreements = AgentAgreement::search($search)
            ->latest()
            ->paginate();

        return new AgentAgreementCollection($agentAgreements);
    }

    public function store(
        AgentAgreementStoreRequest $request
    ): AgentAgreementResource {
        $this->authorize('create', AgentAgreement::class);

        $validated = $request->validated();

        $agentAgreement = AgentAgreement::create($validated);

        return new AgentAgreementResource($agentAgreement);
    }

    public function show(
        Request $request,
        AgentAgreement $agentAgreement
    ): AgentAgreementResource {
        $this->authorize('view', $agentAgreement);

        return new AgentAgreementResource($agentAgreement);
    }

    public function update(
        AgentAgreementUpdateRequest $request,
        AgentAgreement $agentAgreement
    ): AgentAgreementResource {
        $this->authorize('update', $agentAgreement);

        $validated = $request->validated();

        $agentAgreement->update($validated);

        return new AgentAgreementResource($agentAgreement);
    }

    public function destroy(
        Request $request,
        AgentAgreement $agentAgreement
    ): Response {
        $this->authorize('delete', $agentAgreement);

        $agentAgreement->delete();

        return response()->noContent();
    }
}
