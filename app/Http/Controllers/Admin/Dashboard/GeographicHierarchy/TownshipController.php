<?php

namespace App\Http\Controllers\Admin\Dashboard\GeographicHierarchy;

use App\Actions\Admin\GeographicHierarchy\Townships\PermanentlyDeleteTrashedTownshipsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Townships\StoreTownshipRequest;
use App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Townships\UpdateTownshipRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\City;
use App\Models\Region;
use App\Models\Township;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class TownshipController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:townships.view', ['only' => ['index']]);
        $this->middleware('permission:townships.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:townships.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:townships.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:townships.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:townships.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:townships.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $townships = Township::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('city.region:id,name');
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/GeographicHierarchy/Townships/Index', compact('townships'));
    }

    public function create(): Response|ResponseFactory
    {
        $cities = City::select("id", "region_id", "name")->get();

        return inertia('Admin/GeographicHierarchy/Townships/Create', compact('cities'));
    }

    public function store(StoreTownshipRequest $request): RedirectResponse
    {
        Township::create(['city_id' => $request->city_id, 'name' => $request->name]);

        return to_route('admin.townships.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(Township $township): Response|ResponseFactory
    {
        $cities = City::select("id", "region_id", "name")->get();

        return inertia('Admin/GeographicHierarchy/Townships/Edit', compact('cities', 'township'));
    }

    public function update(UpdateTownshipRequest $request, Township $township): RedirectResponse
    {
        $township->update(['city_id' => $request->city_id, 'name' => $request->name]);

        return to_route('admin.townships.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Township $township): RedirectResponse
    {
        $township->delete();

        return to_route('admin.townships.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Township::whereIn('id', $selectedItems)->delete();

        return to_route('admin.townships.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedTownships = Township::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('city.region:id,name');
            })
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/GeographicHierarchy/Townships/Trash', compact('trashedTownships'));
    }

    public function restore(Request $request, int $trashedTownshipId): RedirectResponse
    {
        $trashedTownship = Township::onlyTrashed()->findOrFail($trashedTownshipId);

        $trashedTownship->restore();

        return to_route('admin.townships.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Township::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.townships.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedTownshipId): RedirectResponse
    {
        $trashedTownship = Township::onlyTrashed()->findOrFail($trashedTownshipId);

        $trashedTownship->forceDelete();

        return to_route('admin.townships.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedTownships = Township::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedTownshipsAction())->handle($trashedTownships);

        return to_route('admin.townships.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedTownships = Township::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedTownshipsAction())->handle($trashedTownships);

        return to_route('admin.townships.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
