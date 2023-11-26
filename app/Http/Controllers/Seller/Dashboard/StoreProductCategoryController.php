<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Actions\Seller\StoreProductCategories\PermanentlyDeleteTrashedStoreProductCategoriesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\StoreProductCategoryRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\StoreProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreProductCategoryController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $storeProductCategories = StoreProductCategory::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/StoreProductCategories/Index', compact('storeProductCategories'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Seller/StoreProductCategories/Create');
    }

    public function store(StoreProductCategoryRequest $request): RedirectResponse
    {
        StoreProductCategory::create(["name" => $request->name,"status" => $request->status]);

        return to_route('seller.store-product-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(StoreProductCategory $storeProductCategory): Response|ResponseFactory
    {
        return inertia('Seller/StoreProductCategories/Edit', compact('storeProductCategory'));
    }

    public function update(StoreProductCategoryRequest $request, StoreProductCategory $storeProductCategory): RedirectResponse
    {
        $storeProductCategory->update(["name" => $request->name,"status" => $request->status]);

        return to_route('seller.store-product-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, StoreProductCategory $storeProductCategory): RedirectResponse
    {
        $storeProductCategory->delete();

        return to_route('seller.store-product-categories.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        StoreProductCategory::whereIn('id', $selectedItems)->delete();

        return to_route('seller.store-product-categories.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedStoreProductCategories = StoreProductCategory::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/StoreProductCategories/Trash', compact('trashedStoreProductCategories'));
    }

    public function restore(Request $request, int $trashedStoreProductCategoryId): RedirectResponse
    {
        $trashedStoreProductCategory = StoreProductCategory::onlyTrashed()->findOrFail($trashedStoreProductCategoryId);

        $trashedStoreProductCategory->restore();

        return to_route('seller.store-product-categories.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        StoreProductCategory::onlyTrashed()->whereIn('id', $selectedItems)->restore();

        return to_route('seller.store-product-categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedStoreProductCategoryId): RedirectResponse
    {
        $trashedStoreProductCategory = StoreProductCategory::onlyTrashed()->findOrFail($trashedStoreProductCategoryId);

        $trashedStoreProductCategory->forceDelete();

        return to_route('seller.store-product-categories.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedStoreProductCategories = StoreProductCategory::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedStoreProductCategoriesAction())->handle($trashedStoreProductCategories);

        return to_route('seller.store-product-categories.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedStoreProductCategories = StoreProductCategory::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedStoreProductCategoriesAction())->handle($trashedStoreProductCategories);

        return to_route('seller.store-product-categories.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
