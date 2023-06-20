<?php

namespace App\Http\Controllers\Api;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentTestResource;
use App\Http\Resources\AgentTestCollection;

class DistrictAgentTestsController extends Controller
{
    public function index(
        Request $request,
        District $district
    ): AgentTestCollection {
        $this->authorize('view', $district);

        $search = $request->get('search', '');

        $agentTests = $district
            ->agentTests()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgentTestCollection($agentTests);
    }

    public function store(
        Request $request,
        District $district
    ): AgentTestResource {
        $this->authorize('create', AgentTest::class);

        $validated = $request->validate([]);

        $agentTest = $district->agentTests()->create($validated);

        return new AgentTestResource($agentTest);
    }
}
