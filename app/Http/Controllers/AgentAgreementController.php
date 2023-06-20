<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\AgentAgreement;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AgentAgreementStoreRequest;
use App\Http\Requests\AgentAgreementUpdateRequest;

class AgentAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', AgentAgreement::class);

        $search = $request->get('search', '');

        $agentAgreements = AgentAgreement::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.agent_agreements.index',
            compact('agentAgreements', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', AgentAgreement::class);

        $agents = Agent::pluck('name', 'id');

        return view('app.agent_agreements.create', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentAgreementStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', AgentAgreement::class);

        $validated = $request->validated();

        $agentAgreement = AgentAgreement::create($validated);

        return redirect()
            ->route('agent-agreements.edit', $agentAgreement)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, AgentAgreement $agentAgreement): View
    {
        $this->authorize('view', $agentAgreement);

        return view('app.agent_agreements.show', compact('agentAgreement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AgentAgreement $agentAgreement): View
    {
        $this->authorize('update', $agentAgreement);

        $agents = Agent::pluck('name', 'id');

        return view(
            'app.agent_agreements.edit',
            compact('agentAgreement', 'agents')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AgentAgreementUpdateRequest $request,
        AgentAgreement $agentAgreement
    ): RedirectResponse {
        $this->authorize('update', $agentAgreement);

        $validated = $request->validated();

        $agentAgreement->update($validated);

        return redirect()
            ->route('agent-agreements.edit', $agentAgreement)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        AgentAgreement $agentAgreement
    ): RedirectResponse {
        $this->authorize('delete', $agentAgreement);

        $agentAgreement->delete();

        return redirect()
            ->route('agent-agreements.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
