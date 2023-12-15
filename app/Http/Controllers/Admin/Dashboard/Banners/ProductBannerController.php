<?php

namespace App\Http\Controllers\Admin\Dashboard\Banners;

use App\Actions\Admin\Banners\ProductBanners\PermanentlyDeleteTrashedProductBannersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Banners\ProductBanners\StoreProductBannerRequest;
use App\Http\Requests\Dashboard\Admin\Banners\ProductBanners\UpdateProductBannerRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Http\Traits\ImageUpload;
use App\Models\ProductBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductBannerController extends Controller
{
    use HandlesQueryStringParameters;
    use ImageUpload;

    public function __construct()
    {
        $this->middleware('permission:product-banners.view', ['only' => ['index']]);
        $this->middleware('permission:product-banners.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:product-banners.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:product-banners.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:product-banners.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:product-banners.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:product-banners.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $productBanners = ProductBanner::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Banners/ProductBanners/Index', compact('productBanners'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Banners/ProductBanners/Create');
    }

    public function store(StoreProductBannerRequest $request): RedirectResponse
    {
        $image = isset($request->image) ? $this->createImage($request->image, 'product-banners') : null;

        ProductBanner::create([
            "url" => $request->url,
            "status" => $request->status,
            "image" => $image,
        ]);

        return to_route('admin.product-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(ProductBanner $productBanner): Response|ResponseFactory
    {
        return inertia('Admin/Banners/ProductBanners/Edit', compact('productBanner'));
    }

    public function update(UpdateProductBannerRequest $request, ProductBanner $productBanner): RedirectResponse
    {
        $image = isset($request->image) && !is_string($request->image) ? $this->updateImage($request->image, $productBanner->image, 'product-banners') : $productBanner->image;

        $productBanner->update([
            "url" => $request->url,
            "status" => $request->status,
            "image" => $image,
        ]);

        return to_route('admin.product-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, ProductBanner $productBanner): RedirectResponse
    {
        $productBanner->delete();

        return to_route('admin.product-banners.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ProductBanner::whereIn('id', $selectedItems)->delete();

        return to_route('admin.product-banners.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedProductBanners = ProductBanner::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Banners/ProductBanners/Trash', compact('trashedProductBanners'));
    }

    public function restore(Request $request, int $trashedProductBannerId): RedirectResponse
    {
        $trashedProductBanner = ProductBanner::onlyTrashed()->findOrFail($trashedProductBannerId);

        $trashedProductBanner->restore();

        return to_route('admin.product-banners.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ProductBanner::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedProductBannerId): RedirectResponse
    {
        $trashedProductBanner = ProductBanner::onlyTrashed()->findOrFail($trashedProductBannerId);

        ProductBanner::deleteImage($trashedProductBanner->image);

        $trashedProductBanner->forceDelete();

        return to_route('admin.product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedProductBanners = ProductBanner::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedProductBannersAction())->handle($trashedProductBanners);

        return to_route('admin.product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedProductBanners = ProductBanner::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedProductBannersAction())->handle($trashedProductBanners);

        return to_route('admin.product-banners.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
