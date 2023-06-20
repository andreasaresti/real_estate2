<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageCollection;

class PagePagesController extends Controller
{
    public function index(Request $request, Page $page): PageCollection
    {
        $this->authorize('view', $page);

        $search = $request->get('search', '');

        $pages = $page
            ->pages()
            ->search($search)
            ->latest()
            ->paginate();

        return new PageCollection($pages);
    }

    public function store(Request $request, Page $page): PageResource
    {
        $this->authorize('create', Page::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'json'],
            'slug' => ['required', 'unique:pages,slug', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
            'description' => ['nullable', 'max:255', 'json'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $page = $page->pages()->create($validated);

        return new PageResource($page);
    }
}
