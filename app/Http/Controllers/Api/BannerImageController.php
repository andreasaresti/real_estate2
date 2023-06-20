<?php

namespace App\Http\Controllers\Api;

use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\BannerImageResource;
use App\Http\Resources\BannerImageCollection;
use App\Http\Requests\BannerImageStoreRequest;
use App\Http\Requests\BannerImageUpdateRequest;

class BannerImageController extends Controller
{
    public function index(Request $request): BannerImageCollection
    {
        $this->authorize('view-any', BannerImage::class);

        $search = $request->get('search', '');

        $bannerImages = BannerImage::search($search)
            ->latest()
            ->paginate();

        return new BannerImageCollection($bannerImages);
    }

    public function store(BannerImageStoreRequest $request): BannerImageResource
    {
        $this->authorize('create', BannerImage::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $validated['button_text'] = json_decode(
            $validated['button_text'],
            true
        );

        $bannerImage = BannerImage::create($validated);

        return new BannerImageResource($bannerImage);
    }

    public function show(
        Request $request,
        BannerImage $bannerImage
    ): BannerImageResource {
        $this->authorize('view', $bannerImage);

        return new BannerImageResource($bannerImage);
    }

    public function update(
        BannerImageUpdateRequest $request,
        BannerImage $bannerImage
    ): BannerImageResource {
        $this->authorize('update', $bannerImage);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($bannerImage->image) {
                Storage::delete($bannerImage->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $validated['name'] = json_decode($validated['name'], true);

        $validated['description'] = json_decode(
            $validated['description'],
            true
        );

        $validated['button_text'] = json_decode(
            $validated['button_text'],
            true
        );

        $bannerImage->update($validated);

        return new BannerImageResource($bannerImage);
    }

    public function destroy(
        Request $request,
        BannerImage $bannerImage
    ): Response {
        $this->authorize('delete', $bannerImage);

        if ($bannerImage->image) {
            Storage::delete($bannerImage->image);
        }

        $bannerImage->delete();

        return response()->noContent();
    }
}
