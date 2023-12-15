<?php

namespace App\Http\Controllers\Admin\Dashboard\Banners;

use App\Actions\Admin\Banners\SliderBanners\PermanentlyDeleteTrashedSliderBannersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Banners\SliderBanners\StoreSliderBannerRequest;
use App\Http\Requests\Dashboard\Admin\Banners\SliderBanners\UpdateSliderBannerRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Http\Traits\ImageUpload;
use App\Models\SliderBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class SliderBannerController extends Controller
{
    use HandlesQueryStringParameters;
    use ImageUpload;

    public function __construct()
    {
        $this->middleware('permission:slider-banners.view', ['only' => ['index']]);
        $this->middleware('permission:slider-banners.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:slider-banners.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:slider-banners.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:slider-banners.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:slider-banners.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:slider-banners.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $sliderBanners = SliderBanner::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Banners/SliderBanners/Index', compact('sliderBanners'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Banners/SliderBanners/Create');
    }

    public function store(StoreSliderBannerRequest $request): RedirectResponse
    {
        $image = isset($request->image) ? $this->createImage($request->image, 'slider-banners') : null;

        SliderBanner::create([
            "url" => $request->url,
            "status" => $request->status,
            "image" => $image,
        ]);

        return to_route('admin.slider-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(SliderBanner $sliderBanner): Response|ResponseFactory
    {
        return inertia('Admin/Banners/SliderBanners/Edit', compact('sliderBanner'));
    }

    public function update(UpdateSliderBannerRequest $request, SliderBanner $sliderBanner): RedirectResponse
    {
        $image = isset($request->image) && !is_string($request->image) ? $this->updateImage($request->image, $sliderBanner->image, 'slider-banners') : $sliderBanner->image;

        $sliderBanner->update([
            "url" => $request->url,
            "status" => $request->status,
            "image" => $image,
        ]);

        return to_route('admin.slider-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, SliderBanner $sliderBanner): RedirectResponse
    {
        $sliderBanner->delete();

        return to_route('admin.slider-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        SliderBanner::whereIn('id', $selectedItems)->delete();

        return to_route('admin.slider-banners.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedSliderBanners = SliderBanner::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Banners/SliderBanners/Trash', compact('trashedSliderBanners'));
    }

    public function restore(Request $request, int $trashedSliderBannerId): RedirectResponse
    {
        $trashedSliderBanner = SliderBanner::onlyTrashed()->findOrFail($trashedSliderBannerId);

        $trashedSliderBanner->restore();

        return to_route('admin.slider-banners.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        SliderBanner::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.slider-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedSliderBannerId): RedirectResponse
    {
        $trashedSliderBanner = SliderBanner::onlyTrashed()->findOrFail($trashedSliderBannerId);

        SliderBanner::deleteImage($trashedSliderBanner->image);

        $trashedSliderBanner->forceDelete();

        return to_route('admin.slider-banners.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedSliderBanners = SliderBanner::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedSliderBannersAction())->handle($trashedSliderBanners);

        return to_route('admin.slider-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedSliderBanners = SliderBanner::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedSliderBannersAction())->handle($trashedSliderBanners);

        return to_route('admin.slider-banners.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
