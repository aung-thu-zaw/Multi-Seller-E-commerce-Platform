<?php

namespace App\Http\Controllers\Admin\Dashboard\GeographicHierarchy;

use App\Actions\Admin\GeographicHierarchy\Cities\PermanentlyDeleteTrashedCitiesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Cities\StoreCityRequest;
use App\Http\Requests\Dashboard\Admin\GeographicHierarchy\Cities\UpdateCityRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\City;
use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CityController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:cities.view', ['only' => ['index']]);
        $this->middleware('permission:cities.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:cities.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:cities.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:cities.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:cities.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:cities.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $cities = City::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('region:id,name');
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/GeographicHierarchy/Cities/Index', compact('cities'));
    }

    public function create(): Response|ResponseFactory
    {
        $regions = Region::select("id", "name")->get();

        return inertia('Admin/GeographicHierarchy/Cities/Create', compact("regions"));
    }

    public function store(StoreCityRequest $request): RedirectResponse
    {
        City::create(['region_id' => $request->region_id, 'name' => $request->name]);

        return to_route('admin.cities.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(City $city): Response|ResponseFactory
    {
        $regions = Region::select("id", "name")->get();

        return inertia('Admin/GeographicHierarchy/Cities/Edit', compact('city', 'regions'));
    }

    public function update(UpdateCityRequest $request, City $city): RedirectResponse
    {
        $city->update(['region_id' => $request->region_id, 'name' => $request->name]);

        return to_route('admin.cities.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, City $city): RedirectResponse
    {
        $city->delete();

        return to_route('admin.cities.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        City::whereIn('id', $selectedItems)->delete();

        return to_route('admin.cities.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedCities = City::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/GeographicHierarchy/Cities/Trash', compact('trashedCities'));
    }

    public function restore(Request $request, int $trashedCityId): RedirectResponse
    {
        $trashedCity = City::onlyTrashed()->findOrFail($trashedCityId);

        $trashedCity->restore();

        return to_route('admin.cities.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        City::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.cities.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedCityId): RedirectResponse
    {
        $trashedCity = City::onlyTrashed()->findOrFail($trashedCityId);

        $trashedCity->forceDelete();

        return to_route('admin.cities.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedCities = City::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->get();

        (new PermanentlyDeleteTrashedCitiesAction())->handle($trashedCities);

        return to_route('admin.cities.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedCities = City::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedCitiesAction())->handle($trashedCities);

        return to_route('admin.cities.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
