<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Admin\ShippingAreas\CreateShippingAreaAction;
use App\Actions\Admin\ShippingAreas\PermanentlyDeleteTrashedShippingAreasAction;
use App\Actions\Admin\ShippingAreas\UpdateShippingAreaAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\ShippingAreas\StoreShippingAreaRequest;
use App\Http\Requests\Dashboard\Admin\ShippingAreas\UpdateShippingAreaRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\City;
use App\Models\Region;
use App\Models\ShippingArea;
use App\Models\Township;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ShippingAreaController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:shipping-areas.view', ['only' => ['index']]);
        $this->middleware('permission:shipping-areas.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:shipping-areas.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:shipping-areas.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:shipping-areas.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:shipping-areas.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:shipping-areas.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $shippingAreas = ShippingArea::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('city:id,name', 'region:id,name', 'township:id,name');
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/ShippingAreas/Index', compact('shippingAreas'));
    }

    public function create(): Response|ResponseFactory
    {
        $regions = Region::select("id", "name")->get();

        $cities = City::select("id", "region_id", "name")->get();

        $townships = Township::select("id", "city_id", "name")->get();

        return inertia('Admin/ShippingAreas/Create', compact("regions", "cities", "townships"));
    }

    public function store(StoreShippingAreaRequest $request): RedirectResponse
    {
        (new CreateShippingAreaAction())->handle($request->validated());

        return to_route('admin.shipping-areas.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(ShippingArea $shippingArea): Response|ResponseFactory
    {
        $regions = Region::select("id", "name")->get();

        $cities = City::select("id", "region_id", "name")->get();

        $townships = Township::select("id", "city_id", "name")->get();

        return inertia('Admin/ShippingAreas/Edit', compact("regions", "cities", "townships", "shippingArea"));
    }

    public function update(UpdateShippingAreaRequest $request, ShippingArea $shippingArea): RedirectResponse
    {
        (new UpdateShippingAreaAction())->handle($request->validated(), $shippingArea);

        return to_route('admin.shipping-areas.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, ShippingArea $shippingArea): RedirectResponse
    {
        $shippingArea->delete();

        return to_route('admin.shipping-areas.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ShippingArea::whereIn('id', $selectedItems)->delete();

        return to_route('admin.shipping-areas.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedShippingAreas = ShippingArea::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('city:id,name', 'region:id,name', 'township:id,name');
            })
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/ShippingAreas/Trash', compact('trashedShippingAreas'));
    }

    public function restore(Request $request, int $trashedShippingAreaId): RedirectResponse
    {
        $trashedShippingArea = ShippingArea::onlyTrashed()->findOrFail($trashedShippingAreaId);

        $trashedShippingArea->restore();

        return to_route('admin.shipping-areas.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ShippingArea::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.shipping-areas.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedShippingAreaId): RedirectResponse
    {
        $trashedShippingArea = ShippingArea::onlyTrashed()->findOrFail($trashedShippingAreaId);

        $trashedShippingArea->forceDelete();

        return to_route('admin.shipping-areas.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedShippingAreas = ShippingArea::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedShippingAreasAction())->handle($trashedShippingAreas);

        return to_route('admin.shipping-areas.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedShippingAreas = ShippingArea::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedShippingAreasAction())->handle($trashedShippingAreas);

        return to_route('admin.shipping-areas.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
