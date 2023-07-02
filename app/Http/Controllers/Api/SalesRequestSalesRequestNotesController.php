<?php

namespace App\Http\Controllers\Api;

use App\Models\SalesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalesRequestNoteResource;
use App\Http\Resources\SalesRequestNoteCollection;

class SalesRequestSalesRequestNoteController extends Controller
{
    public function index(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestNoteCollection {
        $this->authorize('view', $salesRequest);

        $search = $request->get('search', '');

        $SalesRequestNote = $salesRequest
            ->SalesRequestNote()
            ->search($search)
            ->latest()
            ->paginate();

        return new SalesRequestNoteCollection($SalesRequestNote);
    }

    public function store(
        Request $request,
        SalesRequest $salesRequest
    ): SalesRequestNoteResource {
        $this->authorize('create', SalesRequestNote::class);

        $validated = $request->validate([
            'sales_request_note_type_id' => [
                'required',
                'exists:sales_request_note_types,id',
            ],
            'description' => ['required', 'max:255', 'string'],
        ]);

        $salesRequestNote = $salesRequest
            ->SalesRequestNote()
            ->create($validated);

        return new SalesRequestNoteResource($salesRequestNote);
    }
}
