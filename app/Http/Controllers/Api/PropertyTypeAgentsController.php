<?php
namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgentCollection;

class PropertyTypeAgentsController extends Controller
{
    public function index(
        Request $request,
        PropertyType $propertyType
    ): AgentCollection {
        $this->authorize('view', $propertyType);

        $search = $request->get('search', '');

        $agents = $propertyType
            ->agents()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgentCollection($agents);
    }

    public function store(
        Request $request,
        PropertyType $propertyType,
        Agent $agent
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType->agents()->syncWithoutDetaching([$agent->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        PropertyType $propertyType,
        Agent $agent
    ): Response {
        $this->authorize('update', $propertyType);

        $propertyType->agents()->detach($agent);

        return response()->noContent();
    }
}
