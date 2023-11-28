<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Actions\Seller\Products\CreateProductAction;
use App\Actions\Seller\Products\PermanentlyDeleteTrashedProductsAction;
use App\Actions\Seller\Products\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\ProductRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreProductCategory;
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

        return inertia('Seller/Products/Index', compact('products'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $store = Store::select("id")->where("seller_id", auth()->id())->first();

        $storeProductCategories = StoreProductCategory::select('id', 'name')
        ->where("store_id", $store->id)
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        return inertia('Seller/Products/Create', compact('categories', 'storeProductCategories', 'brands'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        (new CreateProductAction())->handle($request->validated());

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Product $product): Response|ResponseFactory
    {
        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $store = Store::select("id")->where("seller_id", auth()->id())->first();

        $storeProductCategories = StoreProductCategory::select('id', 'name')
        ->where("store_id", $store->id)
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
        ->where('status', 'active')
        ->get();

        return inertia('Seller/Products/Edit', compact('product', 'categories', 'storeProductCategories', 'brands'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        (new UpdateProductAction())->handle($request->validated(), $product);

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $product->delete();

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Product::whereIn('id', $selectedItems)->delete();

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedProducts = Product::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/Products/Trash', compact('trashedProducts'));
    }

    public function restore(Request $request, int $trashedProductId): RedirectResponse
    {
        $trashedProduct = Product::onlyTrashed()->findOrFail($trashedProductId);

        $trashedProduct->restore();

        return to_route('seller.products.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Product::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('seller.products.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedProductId): RedirectResponse
    {
        $trashedProduct = Product::onlyTrashed()->findOrFail($trashedProductId);

        Product::deleteImage($trashedProduct->image);

        $trashedProduct->forceDelete();

        return to_route('seller.products.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedProducts = Product::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedProductsAction())->handle($trashedProducts);

        return to_route('seller.products.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedProducts = Product::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedProductsAction())->handle($trashedProducts);

        return to_route('seller.products.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
