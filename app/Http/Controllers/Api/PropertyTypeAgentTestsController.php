<?php
namespace App\Http\Controllers\Api;

use App\Models\AgentTest;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentTestCollection;

class PropertyTypeAgentTestsController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): AgentTestCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $agentTests = $propertyType
            ->agentTests()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgentTestCollection($agentTests);
    }

    public function store(
        Request $request,
        PropertyType $propertyType,
        AgentTest $agentTest
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType->agentTests()->syncWithoutDetaching([$agentTest->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        PropertyType $propertyType,
        AgentTest $agentTest
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType->agentTests()->detach($agentTest);

        return response()->noContent();
    }
}
