<?php

namespace App\Http\Controllers\Seller\Dashboard\ProductManage;

use App\Actions\Products\CreateProductAction;
use App\Actions\Products\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductManage\StoreProductRequest;
use App\Http\Requests\Dashboard\ProductManage\UpdateProductRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Http\Traits\ImageUpload;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    use HandlesQueryStringParameters;
    use ImageUpload;

    public function index(): Response|ResponseFactory
    {
        $products = Product::search(request('search'))
            ->where('store_id', Store::getStoreId())
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

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        return inertia('Seller/Products/Create', compact('categories', 'brands'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        (new CreateProductAction())->handle($request->validated());

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Product $product): Response|ResponseFactory
    {
        $product->checkStoreAccess(Store::getStoreId());

        $product->load(['productImages:id,product_id,image', 'skus.attributeOptions.attribute']);

        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        return inertia('Seller/Products/Edit', compact('product', 'categories', 'brands'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->checkStoreAccess(Store::getStoreId());

        (new UpdateProductAction())->handle($request->validated(), $product);

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Product $product): RedirectResponse
    {
        $product->checkStoreAccess(Store::getStoreId());

        $product->delete();

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Product::whereIn('id', $selectedItems)->delete();

        return to_route('seller.products.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }
}
