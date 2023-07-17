<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\BlogResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogCollection;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;

class BlogController extends Controller
{
    public function index(Request $request): BlogCollection
    {
        $this->authorize('view-any', Blog::class);

        $search = $request->get('search', '');

        $blogs = Blog::search($search)
            ->latest()
            ->paginate();

        return new BlogCollection($blogs);
    }

    public function store(BlogStoreRequest $request): BlogResource
    {
        $this->authorize('create', Blog::class);

        $validated = $request->validated();
        $validated['name'] = json_decode($validated['name'], true);

        $blog = Blog::create($validated);

        return new BlogResource($blog);
    }

    public function show(Request $request, Blog $blog): BlogResource
    {
        $this->authorize('view', $blog);

        return new BlogResource($blog);
    }

    public function update(BlogUpdateRequest $request, Blog $blog): BlogResource
    {
        $this->authorize('update', $blog);

        $validated = $request->validated();

        $validated['name'] = json_decode($validated['name'], true);

        $blog->update($validated);

        return new BlogResource($blog);
    }

    public function destroy(Request $request, Blog $blog): Response
    {
        $this->authorize('delete', $blog);

        $blog->delete();

        return response()->noContent();
    }
}
