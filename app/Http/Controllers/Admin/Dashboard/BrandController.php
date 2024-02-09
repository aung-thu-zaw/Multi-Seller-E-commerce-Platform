<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Admin\Brands\CreateBrandAction;
use App\Actions\Admin\Brands\PermanentlyDeleteTrashedBrandsAction;
use App\Actions\Admin\Brands\UpdateBrandAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Brands\StoreBrandRequest;
use App\Http\Requests\Dashboard\Admin\Brands\UpdateBrandRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class BrandController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:brands.view', ['only' => ['index']]);
        $this->middleware('permission:brands.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:brands.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:brands.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:brands.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:brands.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:brands.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $brands = Brand::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Brands/Index', compact('brands'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/Brands/Create');
    }

    public function store(StoreBrandRequest $request): RedirectResponse
    {
        (new CreateBrandAction())->handle($request->validated());

        return to_route('admin.brands.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Brand $brand): Response|ResponseFactory
    {
        return inertia('Admin/Brands/Edit', compact('brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand): RedirectResponse
    {
        ( new UpdateBrandAction())->handle($request->validated(), $brand);

        return to_route('admin.brands.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Brand $brand): RedirectResponse
    {
        $brand->delete();

        return to_route('admin.brands.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Brand::whereIn('id', $selectedItems)->delete();

        return to_route('admin.brands.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedBrands = Brand::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/Brands/Trash', compact('trashedBrands'));
    }

    public function restore(Request $request, int $trashedBrandId): RedirectResponse
    {
        $trashedBrand = Brand::onlyTrashed()->findOrFail($trashedBrandId);

        $trashedBrand->restore();

        return to_route('admin.brands.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Brand::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.brands.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedBrandId): RedirectResponse
    {
        $trashedBrand = Brand::onlyTrashed()->findOrFail($trashedBrandId);

        Brand::deleteImage($trashedBrand->logo);

        $trashedBrand->forceDelete();

        return to_route('admin.brands.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedBrands = Brand::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedBrandsAction())->handle($trashedBrands);

        return to_route('admin.brands.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedBrands = Brand::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedBrandsAction())->handle($trashedBrands);

        return to_route('admin.brands.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
