<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\IntermediateAgent;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\IntermediateAgentStoreRequest;
use App\Http\Requests\IntermediateAgentUpdateRequest;

class IntermediateAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', IntermediateAgent::class);

        $search = $request->get('search', '');

        $intermediateAgents = IntermediateAgent::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.intermediate_agents.index',
            compact('intermediateAgents', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', IntermediateAgent::class);

        return view('app.intermediate_agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        IntermediateAgentStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', IntermediateAgent::class);

        $validated = $request->validated();

        $intermediateAgent = IntermediateAgent::create($validated);

        return redirect()
            ->route('intermediate-agents.edit', $intermediateAgent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        IntermediateAgent $intermediateAgent
    ): View {
        $this->authorize('view', $intermediateAgent);

        return view(
            'app.intermediate_agents.show',
            compact('intermediateAgent')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        IntermediateAgent $intermediateAgent
    ): View {
        $this->authorize('update', $intermediateAgent);

        return view(
            'app.intermediate_agents.edit',
            compact('intermediateAgent')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        IntermediateAgentUpdateRequest $request,
        IntermediateAgent $intermediateAgent
    ): RedirectResponse {
        $this->authorize('update', $intermediateAgent);

        $validated = $request->validated();

        $intermediateAgent->update($validated);

        return redirect()
            ->route('intermediate-agents.edit', $intermediateAgent)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        IntermediateAgent $intermediateAgent
    ): RedirectResponse {
        $this->authorize('delete', $intermediateAgent);

        $intermediateAgent->delete();

        return redirect()
            ->route('intermediate-agents.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
