<?php

namespace App\Http\Controllers\Api;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerImageResource;
use App\Http\Resources\BannerImageCollection;

class BannerBannerImagesController extends Controller
{
    public function index(
        Request $request,
        Banner $banner
    ): BannerImageCollection {
        $this->authorize('view', $banner);

        $search = $request->get('search', '');

        $bannerImages = $banner
            ->bannerImages()
            ->search($search)
            ->latest()
            ->paginate();

        return new BannerImageCollection($bannerImages);
    }

    public function store(Request $request, Banner $banner): BannerImageResource
    {
        $this->authorize('create', BannerImage::class);

        $validated = $request->validate([
            'image' => ['required', 'image', 'max:1024'],
            'name' => ['nullable', 'max:255', 'json'],
            'description' => ['nullable', 'max:255', 'json'],
            'button_text' => ['nullable', 'max:255', 'json'],
            'link' => ['nullable', 'max:255', 'string'],
            'language_id' => ['nullable', 'exists:languages,id'],
            'active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $bannerImage = $banner->bannerImages()->create($validated);

        return new BannerImageResource($bannerImage);
    }
}
