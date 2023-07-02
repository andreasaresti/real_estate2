<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\SalesRequestNoteType;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SalesRequestNoteTypeStoreRequest;
use App\Http\Requests\SalesRequestNoteTypeUpdateRequest;

class SalesRequestNoteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', SalesRequestNoteType::class);

        $search = $request->get('search', '');

        $salesRequestNoteTypes = SalesRequestNoteType::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.sales_request_note_types.index',
            compact('salesRequestNoteTypes', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', SalesRequestNoteType::class);

        return view('app.sales_request_note_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        SalesRequestNoteTypeStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', SalesRequestNoteType::class);

        $validated = $request->validated();

        $salesRequestNoteType = SalesRequestNoteType::create($validated);

        return redirect()
            ->route('sales-request-note-types.edit', $salesRequestNoteType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        SalesRequestNoteType $salesRequestNoteType
    ): View {
        $this->authorize('view', $salesRequestNoteType);

        return view(
            'app.sales_request_note_types.show',
            compact('salesRequestNoteType')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        SalesRequestNoteType $salesRequestNoteType
    ): View {
        $this->authorize('update', $salesRequestNoteType);

        return view(
            'app.sales_request_note_types.edit',
            compact('salesRequestNoteType')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SalesRequestNoteTypeUpdateRequest $request,
        SalesRequestNoteType $salesRequestNoteType
    ): RedirectResponse {
        $this->authorize('update', $salesRequestNoteType);

        $validated = $request->validated();

        $salesRequestNoteType->update($validated);

        return redirect()
            ->route('sales-request-note-types.edit', $salesRequestNoteType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        SalesRequestNoteType $salesRequestNoteType
    ): RedirectResponse {
        $this->authorize('delete', $salesRequestNoteType);

        $salesRequestNoteType->delete();

        return redirect()
            ->route('sales-request-note-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
