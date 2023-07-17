<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogPost;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BlogPostStoreRequest;
use App\Http\Requests\BlogPostUpdateRequest;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', BlogPost::class);

        $search = $request->get('search', '');

        $blogPosts = BlogPost::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.blog_posts.index', compact('blogPosts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', BlogPost::class);

        $blogs = Blog::pluck('name', 'id');

        return view('app.blog_posts.create', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogPostStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', BlogPost::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $blogPost = BlogPost::create($validated);

        return redirect()
            ->route('blog-posts.edit', $blogPost)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, BlogPost $blogPost): View
    {
        $this->authorize('view', $blogPost);

        return view('app.blog_posts.show', compact('blogPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BlogPost $blogPost): View
    {
        $this->authorize('update', $blogPost);

        $blogs = Blog::pluck('name', 'id');

        return view('app.blog_posts.edit', compact('blogPost', 'blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BlogPostUpdateRequest $request,
        BlogPost $blogPost
    ): RedirectResponse {
        $this->authorize('update', $blogPost);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($blogPost->image) {
                Storage::delete($blogPost->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $blogPost->update($validated);

        return redirect()
            ->route('blog-posts.edit', $blogPost)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        BlogPost $blogPost
    ): RedirectResponse {
        $this->authorize('delete', $blogPost);

        if ($blogPost->image) {
            Storage::delete($blogPost->image);
        }

        $blogPost->delete();

        return redirect()
            ->route('blog-posts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
