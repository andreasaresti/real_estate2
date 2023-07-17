<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Http\Resources\BlogPostCollection;

class BlogBlogPostsController extends Controller
{
    public function index(Request $request, Blog $blog): BlogPostCollection
    {
        $this->authorize('view', $blog);

        $search = $request->get('search', '');

        $blogPosts = $blog
            ->blogPosts()
            ->search($search)
            ->latest()
            ->paginate();

        return new BlogPostCollection($blogPosts);
    }

    public function store(Request $request, Blog $blog): BlogPostResource
    {
        $this->authorize('create', BlogPost::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'description' => ['required', 'max:255', 'json'],
            'publish_on' => ['nullable', 'date'],
            'priority' => ['required', 'numeric'],
            'published' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $blogPost = $blog->blogPosts()->create($validated);

        return new BlogPostResource($blogPost);
    }
}
