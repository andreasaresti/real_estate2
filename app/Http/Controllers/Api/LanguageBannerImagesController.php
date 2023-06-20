<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerImageResource;
use App\Http\Resources\BannerImageCollection;

class LanguageBannerImagesController extends Controller
{
    public function index(
        Request $request,
        Language $language
    ): BannerImageCollection {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $bannerImages = $language
            ->bannerImages()
            ->search($search)
            ->latest()
            ->paginate();

        return new BannerImageCollection($bannerImages);
    }

    public function store(
        Request $request,
        Language $language
    ): BannerImageResource {
        $this->authorize('create', BannerImage::class);

        $validated = $request->validate([
            'banner_id' => ['required', 'exists:banners,id'],
            'image' => ['required', 'image', 'max:1024'],
            'name' => ['nullable', 'max:255', 'json'],
            'description' => ['nullable', 'max:255', 'json'],
            'button_text' => ['nullable', 'max:255', 'json'],
            'link' => ['nullable', 'max:255', 'string'],
            'active' => ['required', 'boolean'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $bannerImage = $language->bannerImages()->create($validated);

        return new BannerImageResource($bannerImage);
    }
}
