<?php

namespace App\Http\Controllers\Api;

use App\Models\PropertyType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PropertyTypeResource;
use App\Http\Resources\PropertyTypeCollection;
use App\Http\Requests\PropertyTypeStoreRequest;
use App\Http\Requests\PropertyTypeUpdateRequest;

class PropertyTypeController extends Controller
{
    public function index(Request $request): PropertyTypeCollection
    {
        $this->authorize('view-any', PropertyType::class);

        $search = $request->get('search', '');

        $propertyTypes = PropertyType::search($search)
            ->latest()
            ->paginate();

        return new PropertyTypeCollection($propertyTypes);
    }

    public function store(
        PropertyTypeStoreRequest $request
    ): PropertyTypeResource {
        $this->authorize('create', PropertyType::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $propertyType = PropertyType::create($validated);

        return new PropertyTypeResource($propertyType);
    }

    public function show(
        Request $request,
        PropertyType $propertyType
    ): PropertyTypeResource {
        $this->authorize('view', $propertyType);

        return new PropertyTypeResource($propertyType);
    }

    public function update(
        PropertyTypeUpdateRequest $request,
        PropertyType $propertyType
    ): PropertyTypeResource {
        $this->authorize('update', $propertyType);

        $validated = $request->validated();

        $validated['name'] = json_decode($validated['name'], true);

        $propertyType->update($validated);

        return new PropertyTypeResource($propertyType);
    }

    public function destroy(
        Request $request,
        PropertyType $propertyType
    ): Response {
        $this->authorize('delete', $propertyType);

        $propertyType->delete();

        return response()->noContent();
    }
}
