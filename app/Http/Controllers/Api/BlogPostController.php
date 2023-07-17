<?php

namespace App\Http\Controllers\Api;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BlogPostResource;
use App\Http\Resources\BlogPostCollection;
use App\Http\Requests\BlogPostStoreRequest;
use App\Http\Requests\BlogPostUpdateRequest;

class BlogPostController extends Controller
{
    public function index(Request $request): BlogPostCollection
    {
        $this->authorize('view-any', BlogPost::class);

        $search = $request->get('search', '');

        $blogPosts = BlogPost::search($search)
            ->latest()
            ->paginate();

        return new BlogPostCollection($blogPosts);
    }

    public function store(BlogPostStoreRequest $request): BlogPostResource
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

        return new BlogPostResource($blogPost);
    }

    public function show(Request $request, BlogPost $blogPost): BlogPostResource
    {
        $this->authorize('view', $blogPost);

        return new BlogPostResource($blogPost);
    }

    public function update(
        BlogPostUpdateRequest $request,
        BlogPost $blogPost
    ): BlogPostResource {
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

        return new BlogPostResource($blogPost);
    }

    public function destroy(Request $request, BlogPost $blogPost): Response
    {
        $this->authorize('delete', $blogPost);

        if ($blogPost->image) {
            Storage::delete($blogPost->image);
        }

        $blogPost->delete();

        return response()->noContent();
    }
}
