<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Products\CreateProductAction;
use App\Actions\Products\PermanentlyDeleteTrashedProductsAction;
use App\Actions\Products\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductManage\StoreProductRequest;
use App\Http\Requests\Dashboard\ProductManage\UpdateProductRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $products = Product::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Products/Index', compact('products'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        $activeStores = Store::select("id", "store_name")->where("status", "active")->get();

        $stores = $activeStores->map(function ($activeStores) {
            return [
                'id'   => $activeStores->id,
                'name' => $activeStores->store_name,
            ];
        });

        return inertia('Admin/Products/Create', compact('categories', 'brands', 'stores'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        (new CreateProductAction())->handle($request->validated());

        return to_route('admin.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Product $product): Response|ResponseFactory
    {
        $product->load(['productImages:id,product_id,image', 'skus.attributeOptions.attribute']);

        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        $activeStores = Store::select("id", "store_name")->where("status", "active")->get();

        $stores = $activeStores->map(function ($activeStores) {
            return [
                'id'   => $activeStores->id,
                'name' => $activeStores->store_name,
            ];
        });

        return inertia('Admin/Products/Edit', compact('product', 'categories', 'brands', 'stores'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        (new UpdateProductAction())->handle($request->validated(), $product);

        return to_route('admin.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $product->delete();

        return to_route('admin.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Product::whereIn('id', $selectedItems)->delete();

        return to_route('admin.products.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedProducts = Product::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Products/Trash', compact('trashedProducts'));
    }

    public function restore(Request $request, int $trashedProductId): RedirectResponse
    {
        $trashedProduct = Product::onlyTrashed()->findOrFail($trashedProductId);

        $trashedProduct->restore();

        return to_route('admin.products.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Product::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.products.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedProductId): RedirectResponse
    {
        $trashedProduct = Product::onlyTrashed()->findOrFail($trashedProductId);

        $productImages = ProductImage::where("product_id", $trashedProduct)->get();

        $productImages->each(function ($image) {

            ProductImage::deleteImage($image);

            $image->delete();

        });

        Product::deleteImage($trashedProduct->image);

        $trashedProduct->forceDelete();

        return to_route('admin.products.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedProducts = Product::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedProductsAction())->handle($trashedProducts);

        return to_route('admin.products.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedProducts = Product::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedProductsAction())->handle($trashedProducts);

        return to_route('admin.products.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
