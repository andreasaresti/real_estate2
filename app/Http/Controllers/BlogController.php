<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Blog::class);

        $search = $request->get('search', '');

        $blogs = Blog::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.blogs.index', compact('blogs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Blog::class);

        return view('app.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Blog::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $blog = Blog::create($validated);

        return redirect()
            ->route('blogs.edit', $blog)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Blog $blog): View
    {
        $this->authorize('view', $blog);

        return view('app.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Blog $blog): View
    {
        $this->authorize('update', $blog);

        return view('app.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BlogUpdateRequest $request,
        Blog $blog
    ): RedirectResponse {
        $this->authorize('update', $blog);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $blog->update($validated);

        return redirect()
            ->route('blogs.edit', $blog)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Blog $blog): RedirectResponse
    {
        $this->authorize('delete', $blog);

        $blog->delete();

        return redirect()
            ->route('blogs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
