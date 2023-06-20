<?php

namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentAgreementResource;
use App\Http\Resources\AgentAgreementCollection;

class AgentAgentAgreementsController extends Controller
{
    public function index(
        Request $request,
        Agent $agent
    ): AgentAgreementCollection {
        $this->authorize('view', $agent);

        $search = $request->get('search', '');

        $agentAgreements = $agent
            ->agentAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgentAgreementCollection($agentAgreements);
    }

    public function store(
        Request $request,
        Agent $agent
    ): AgentAgreementResource {
        $this->authorize('create', AgentAgreement::class);

        $validated = $request->validate([
            'agency_commission_percentage' => ['required', 'numeric'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ]);

        $agentAgreement = $agent->agentAgreements()->create($validated);

        return new AgentAgreementResource($agentAgreement);
    }
}
