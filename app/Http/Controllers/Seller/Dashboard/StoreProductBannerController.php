<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Actions\Seller\StoreProductBanners\PermanentlyDeleteTrashedStoreProductBannersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\StoreProductBannerRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Http\Traits\ImageUpload;
use App\Models\Store;
use App\Models\StoreProductBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;
use Illuminate\Support\Str;

class StoreProductBannerController extends Controller
{
    use ImageUpload;
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $storeProductBanners = StoreProductBanner::search(request('search'))
        ->where('store_id', Store::getStoreId())
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/StoreProductBanners/Index', compact('storeProductBanners'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Seller/StoreProductBanners/Create');
    }

    public function store(StoreProductBannerRequest $request): RedirectResponse
    {
        $image = isset($request->image) ? $this->createImage($request->image, 'store-product-banners') : null;

        StoreProductBanner::create([
            'store_id' => Store::getStoreId(),
            'uuid' => Str::uuid(),
            'url' => $request->url,
            'status' => $request->status,
            'image' => $image,
        ]);

        return to_route('seller.store-product-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(StoreProductBanner $storeProductBanner): Response|ResponseFactory
    {
        $storeProductBanner->checkStoreAccess(Store::getStoreId());

        return inertia('Seller/StoreProductBanners/Edit', compact('storeProductBanner'));
    }

    public function update(StoreProductBannerRequest $request, StoreProductBanner $storeProductBanner): RedirectResponse
    {
        $storeProductBanner->checkStoreAccess(Store::getStoreId());

        $image = isset($request->image) && !is_string($request->image) ? $this->updateImage($request->image, $storeProductBanner->image, 'store-product-banners') : $storeProductBanner->image;

        $storeProductBanner->update([
            'url' => $request->url,
            'status' => $request->status,
            'image' => $image,
        ]);

        return to_route('seller.store-product-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, StoreProductBanner $storeProductBanner): RedirectResponse
    {
        $storeProductBanner->checkStoreAccess(Store::getStoreId());

        $storeProductBanner->delete();

        return to_route('seller.store-product-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        StoreProductBanner::where('store_id', Store::getStoreId())->whereIn('id', $selectedItems)->delete();

        return to_route('seller.store-product-banners.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedStoreProductBanners = StoreProductBanner::search(request('search'))
            ->onlyTrashed()
            ->where('store_id', Store::getStoreId())
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/StoreProductBanners/Trash', compact('trashedStoreProductBanners'));
    }

    public function restore(Request $request, int $trashedStoreProductBannerId): RedirectResponse
    {
        $trashedStoreProductBanner = StoreProductBanner::onlyTrashed()->findOrFail($trashedStoreProductBannerId);

        $trashedStoreProductBanner->checkStoreAccess(Store::getStoreId());

        $trashedStoreProductBanner->restore();

        return to_route('seller.store-product-banners.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        StoreProductBanner::onlyTrashed()
        ->where('store_id', Store::getStoreId())
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('seller.store-product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedStoreProductBannerId): RedirectResponse
    {
        $trashedStoreProductBanner = StoreProductBanner::onlyTrashed()->findOrFail($trashedStoreProductBannerId);

        $trashedStoreProductBanner->checkStoreAccess(Store::getStoreId());

        StoreProductBanner::deleteImage($trashedStoreProductBanner->image);

        $trashedStoreProductBanner->forceDelete();

        return to_route('seller.store-product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedStoreProductBanners = StoreProductBanner::onlyTrashed()->where('store_id', Store::getStoreId())->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedStoreProductBannersAction())->handle($trashedStoreProductBanners);

        return to_route('seller.store-product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedStoreProductBanners = StoreProductBanner::onlyTrashed()->where('store_id', Store::getStoreId())->get();

        (new PermanentlyDeleteTrashedStoreProductBannersAction())->handle($trashedStoreProductBanners);

        return to_route('seller.store-product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
