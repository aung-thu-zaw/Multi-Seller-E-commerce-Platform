<?php

namespace App\Http\Controllers\Seller\Dashboard\ProductManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\ProductManage\ProductRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
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

        return inertia('Seller/ProductManage/Products/Index', compact('products'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        return inertia('Seller/ProductManage/Products/Create', compact('categories', 'brands'));
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

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        return inertia('Seller/ProductManage/Products/Edit', compact('product', 'categories', 'brands'));
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
}
