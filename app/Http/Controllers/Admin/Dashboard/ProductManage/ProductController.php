<?php

namespace App\Http\Controllers\Admin\Dashboard\ProductManage;

use App\Actions\Admin\Products\CreateProductAction;
use App\Actions\Admin\Products\PermanentlyDeleteTrashedProductsAction;
use App\Actions\Admin\Products\UpdateProductAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\ProductManage\Products\StoreProductRequest;
use App\Http\Requests\Dashboard\Admin\ProductManage\Products\UpdateProductRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreProductCategory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:products.view', ['only' => ['index']]);
        $this->middleware('permission:products.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:products.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:products.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:products.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:products.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:products.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $products = Product::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/ProductManage/Products/Index', compact('products'));
    }

    public function create(): Response|ResponseFactory
    {
        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        $stores = Store::select("id", "name")->where("status", "active")->get();

        return inertia('Admin/ProductManage/Products/Create', compact('categories', 'brands', 'stores'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        (new CreateProductAction())->handle($request->validated());

        return to_route('admin.products.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Product $product): Response|ResponseFactory
    {
        $categories = Category::select('id', 'name')
            ->where('status', 'show')
            ->get();

        $brands = Brand::select('id', 'name')
            ->where('status', 'active')
            ->get();

        $stores = Store::select("id", "name")->where("status", "active")->get();

        return inertia('Admin/ProductManage/Products/Edit', compact('product', 'categories', 'brands', 'stores'));
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

        return inertia('Admin/ProductManage/Products/Trash', compact('trashedProducts'));
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
