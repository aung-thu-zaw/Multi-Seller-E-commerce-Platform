<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Admin\ShippingRates\CreateShippingRateAction;
use App\Actions\Admin\ShippingRates\PermanentlyDeleteTrashedShippingRatesAction;
use App\Actions\Admin\ShippingRates\UpdateShippingRateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\ShippingRates\StoreShippingRateRequest;
use App\Http\Requests\Dashboard\Admin\ShippingRates\UpdateShippingRateRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\ShippingRate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ShippingRateController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:shipping-rates.view', ['only' => ['index']]);
        $this->middleware('permission:shipping-rates.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:shipping-rates.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:shipping-rates.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:shipping-rates.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:shipping-rates.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:shipping-rates.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $shippingRates = ShippingRate::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/ShippingRates/Index', compact('shippingRates'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/ShippingRates/Create');
    }

    public function store(StoreShippingRateRequest $request): RedirectResponse
    {
        (new CreateShippingRateAction())->handle($request->validated());

        return to_route('admin.shipping-rates.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(ShippingRate $shippingRate): Response|ResponseFactory
    {
        return inertia('Admin/ShippingRates/Edit', compact('shippingRate'));
    }

    public function update(UpdateShippingRateRequest $request, ShippingRate $shippingRate): RedirectResponse
    {
        (new UpdateShippingRateAction())->handle($request->validated(), $shippingRate);

        return to_route('admin.shipping-rates.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, ShippingRate $shippingRate): RedirectResponse
    {
        $shippingRate->delete();

        return to_route('admin.shipping-rates.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ShippingRate::whereIn('id', $selectedItems)->delete();

        return to_route('admin.shipping-rates.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedShippingRates = ShippingRate::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/ShippingRates/Trash', compact('trashedShippingRates'));
    }

    public function restore(Request $request, int $trashedShippingRateId): RedirectResponse
    {
        $trashedShippingRate = ShippingRate::onlyTrashed()->findOrFail($trashedShippingRateId);

        $trashedShippingRate->restore();

        return to_route('admin.shipping-rates.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ShippingRate::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.shipping-rates.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedShippingRateId): RedirectResponse
    {
        $trashedShippingRate = ShippingRate::onlyTrashed()->findOrFail($trashedShippingRateId);

        $trashedShippingRate->forceDelete();

        return to_route('admin.shipping-rates.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedShippingRates = ShippingRate::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedShippingRatesAction())->handle($trashedShippingRates);

        return to_route('admin.shipping-rates.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedShippingRates = ShippingRate::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedShippingRatesAction())->handle($trashedShippingRates);

        return to_route('admin.shipping-rates.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
