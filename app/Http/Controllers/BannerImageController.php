<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Language;
use Illuminate\View\View;
use App\Models\BannerImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BannerImageStoreRequest;
use App\Http\Requests\BannerImageUpdateRequest;

class BannerImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', BannerImage::class);

        $search = $request->get('search', '');

        $bannerImages = BannerImage::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.banner_images.index',
            compact('bannerImages', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', BannerImage::class);

        $banners = Banner::pluck('name', 'id');
        $languages = Language::pluck('name', 'id');

        return view(
            'app.banner_images.create',
            compact('banners', 'languages')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerImageStoreRequest $request): RedirectResponse
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

        return redirect()
            ->route('banner-images.edit', $bannerImage)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, BannerImage $bannerImage): View
    {
        $this->authorize('view', $bannerImage);

        return view('app.banner_images.show', compact('bannerImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, BannerImage $bannerImage): View
    {
        $this->authorize('update', $bannerImage);

        $banners = Banner::pluck('name', 'id');
        $languages = Language::pluck('name', 'id');

        return view(
            'app.banner_images.edit',
            compact('bannerImage', 'banners', 'languages')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BannerImageUpdateRequest $request,
        BannerImage $bannerImage
    ): RedirectResponse {
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

        return redirect()
            ->route('banner-images.edit', $bannerImage)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        BannerImage $bannerImage
    ): RedirectResponse {
        $this->authorize('delete', $bannerImage);

        if ($bannerImage->image) {
            Storage::delete($bannerImage->image);
        }

        $bannerImage->delete();

        return redirect()
            ->route('banner-images.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
