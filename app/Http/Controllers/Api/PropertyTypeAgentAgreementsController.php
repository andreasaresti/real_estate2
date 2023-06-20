<?php

namespace App\Http\Controllers\Api;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentAgreementResource;
use App\Http\Resources\AgentAgreementCollection;

class PropertyTypeAgentAgreementsController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): AgentAgreementCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $agentAgreements = $propertyType
            ->agentAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgentAgreementCollection($agentAgreements);
    }

    public function store(
        Request $request,
        PropertyType $propertyType
    ): AgentAgreementResource {
        $this->authorize('create', AgentAgreement::class);

        $validated = $request->validate([
            'agent_id' => ['required', 'exists:agents,id'],
            'agency_commission_percentage' => ['required', 'numeric'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ]);

        $agentAgreement = $propertyType->agentAgreements()->create($validated);

        return new AgentAgreementResource($agentAgreement);
    }
}
