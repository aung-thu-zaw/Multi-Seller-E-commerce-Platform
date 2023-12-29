<?php

namespace App\Http\Controllers\Admin\Dashboard\GeographicHierarchy;

use App\Actions\Admin\GeographicHierarchy\Regions\PermanentlyDeleteTrashedRegionsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Regions\StoreRegionRequest;
use App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Regions\UpdateRegionRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Region;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class RegionController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:regions.view', ['only' => ['index']]);
        $this->middleware('permission:regions.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:regions.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:regions.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:regions.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:regions.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:regions.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $regions = Region::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/GeographicHierarchy/Regions/Index', compact('regions'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/GeographicHierarchy/Regions/Create');
    }

    public function store(StoreRegionRequest $request): RedirectResponse
    {
        Region::create(["name" => $request->name]);

        return to_route('admin.regions.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Region $region): Response|ResponseFactory
    {
        return inertia('Admin/GeographicHierarchy/Regions/Edit', compact('region'));
    }

    public function update(UpdateRegionRequest $request, Region $region): RedirectResponse
    {
        $region->update(["name" => $request->name]);

        return to_route('admin.regions.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Region $region): RedirectResponse
    {
        $region->delete();

        return to_route('admin.regions.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Region::whereIn('id', $selectedItems)->delete();

        return to_route('admin.regions.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedRegions = Region::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/GeographicHierarchy/Regions/Trash', compact('trashedRegions'));
    }

    public function restore(Request $request, int $trashedRegionId): RedirectResponse
    {
        $trashedRegion = Region::onlyTrashed()->findOrFail($trashedRegionId);

        $trashedRegion->restore();

        return to_route('admin.regions.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Region::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.regions.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedRegionId): RedirectResponse
    {
        $trashedRegion = Region::onlyTrashed()->findOrFail($trashedRegionId);

        $trashedRegion->forceDelete();

        return to_route('admin.regions.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedRegions = Region::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedRegionsAction())->handle($trashedRegions);

        return to_route('admin.regions.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedRegions = Region::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedRegionsAction())->handle($trashedRegions);

        return to_route('admin.regions.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
