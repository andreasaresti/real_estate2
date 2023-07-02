<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\SalesRequestNoteType;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestNoteResource;
use App\Http\Resources\SalesRequestNoteCollection;

class SalesRequestNoteTypeSalesRequestNoteController extends Controller
{
    public function index(
        Request $request,
        SalesRequestNoteType $salesRequestNoteType
    ): SalesRequestNoteCollection {
        $this->authorize('view', $salesRequestNoteType);

        $search = $request->get('search', '');

        $SalesRequestNote = $salesRequestNoteType
            ->SalesRequestNote()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestNoteCollection($SalesRequestNote);
    }

    public function store(
        Request $request,
        SalesRequestNoteType $salesRequestNoteType
    ): SalesRequestNoteResource {
        $this->authorize('create', SalesRequestNote::class);

        $validated = $request->validate([
            'sales_request_id' => ['required', 'exists:sales_requests,id'],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $salesRequestNote = $salesRequestNoteType
            ->SalesRequestNote()
            ->create($validated);

        return new SalesRequestNoteResource($salesRequestNote);
    }
}
