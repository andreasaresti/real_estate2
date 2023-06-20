<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AgentStoreRequest;
use App\Http\Requests\AgentUpdateRequest;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Agent::class);

        $search = $request->get('search', '');

        $agents = Agent::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.agents.index', compact('agents', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Agent::class);

        return view('app.agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Agent::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $agent = Agent::create($validated);

        return redirect()
            ->route('agents.edit', $agent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Agent $agent): View
    {
        $this->authorize('view', $agent);

        return view('app.agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Agent $agent): View
    {
        $this->authorize('update', $agent);

        return view('app.agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AgentUpdateRequest $request,
        Agent $agent
    ): RedirectResponse {
        $this->authorize('update', $agent);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($agent->image) {
                Storage::delete($agent->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $agent->update($validated);

        return redirect()
            ->route('agents.edit', $agent)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Agent $agent): RedirectResponse
    {
        $this->authorize('delete', $agent);

        if ($agent->image) {
            Storage::delete($agent->image);
        }

        $agent->delete();

        return redirect()
            ->route('agents.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
