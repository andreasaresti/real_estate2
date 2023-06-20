<?php

namespace App\Http\Controllers\Api;

use App\Models\ListingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentAgreementResource;
use App\Http\Resources\AgentAgreementCollection;

class ListingTypeAgentAgreementsController extends Controller
{
    public function index(
        Request $request,
        ListingType $listingType
    ): AgentAgreementCollection {
        $this->authorize('view', $listingType);

        $search = $request->get('search', '');

        $agentAgreements = $listingType
            ->agentAgreements()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgentAgreementCollection($agentAgreements);
    }

    public function store(
        Request $request,
        ListingType $listingType
    ): AgentAgreementResource {
        $this->authorize('create', AgentAgreement::class);

        $validated = $request->validate([
            'agent_id' => ['required', 'exists:agents,id'],
            'agency_commission_percentage' => ['required', 'numeric'],
            'salespeople_commission_percentage' => ['required', 'numeric'],
        ]);

        $agentAgreement = $listingType->agentAgreements()->create($validated);

        return new AgentAgreementResource($agentAgreement);
    }
}
