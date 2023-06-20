<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\InternalStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\InternalStatusStoreRequest;
use App\Http\Requests\InternalStatusUpdateRequest;

class InternalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', InternalStatus::class);

        $search = $request->get('search', '');

        $internalStatuses = InternalStatus::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.internal_statuses.index',
            compact('internalStatuses', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', InternalStatus::class);

        return view('app.internal_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InternalStatusStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', InternalStatus::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $internalStatus = InternalStatus::create($validated);

        return redirect()
            ->route('internal-statuses.edit', $internalStatus)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, InternalStatus $internalStatus): View
    {
        $this->authorize('view', $internalStatus);

        return view('app.internal_statuses.show', compact('internalStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, InternalStatus $internalStatus): View
    {
        $this->authorize('update', $internalStatus);

        return view('app.internal_statuses.edit', compact('internalStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        InternalStatusUpdateRequest $request,
        InternalStatus $internalStatus
    ): RedirectResponse {
        $this->authorize('update', $internalStatus);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($internalStatus->image) {
                Storage::delete($internalStatus->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $internalStatus->update($validated);

        return redirect()
            ->route('internal-statuses.edit', $internalStatus)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        InternalStatus $internalStatus
    ): RedirectResponse {
        $this->authorize('delete', $internalStatus);

        if ($internalStatus->image) {
            Storage::delete($internalStatus->image);
        }

        $internalStatus->delete();

        return redirect()
            ->route('internal-statuses.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
