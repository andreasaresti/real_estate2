<?php
namespace App\Http\Controllers\Api;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyTypeCollection;

class AgentPropertyTypesController extends Controller
{
    public function index(
        Request $request,
        Agent $agent
    ): PropertyTypeCollection {
        $this->authorize('view', $agent);

        $search = $request->get('search', '');

        $propertyTypes = $agent
            ->listingTypes()
            ->search($search)
            ->latest()
            ->paginate();

        return new PropertyTypeCollection($propertyTypes);
    }

    public function store(
        Request $request,
        Agent $agent,
        PropertyType $propertyType
    ): Response {
        $this->authorize('update', $agent);

        $agent->listingTypes()->syncWithoutDetaching([$propertyType->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Agent $agent,
        PropertyType $propertyType
    ): Response {
        $this->authorize('update', $agent);

        $agent->listingTypes()->detach($propertyType);

        return response()->noContent();
    }
}
