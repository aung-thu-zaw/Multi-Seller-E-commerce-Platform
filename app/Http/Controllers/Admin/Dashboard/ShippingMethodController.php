<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Actions\Admin\ShippingMethods\PermanentlyDeleteTrashedShippingMethodsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\ShippingMethods\StoreShippingMethodRequest;
use App\Http\Requests\Dashboard\Admin\ShippingMethods\UpdateShippingMethodRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\ShippingMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ShippingMethodController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:shipping-methods.view', ['only' => ['index']]);
        $this->middleware('permission:shipping-methods.create', ['only' => ['create', 'store']]);
        $this->middleware('permission:shipping-methods.edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:shipping-methods.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:shipping-methods.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:shipping-methods.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:shipping-methods.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $shippingMethods = ShippingMethod::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/ShippingMethods/Index', compact('shippingMethods'));
    }

    public function create(): Response|ResponseFactory
    {
        return inertia('Admin/ShippingMethods/Create');
    }

    public function store(StoreShippingMethodRequest $request): RedirectResponse
    {
        ShippingMethod::create(["name" => $request->name]);

        return to_route('admin.shipping-methods.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully created.');
    }

    public function edit(ShippingMethod $shippingMethod): Response|ResponseFactory
    {
        return inertia('Admin/ShippingMethods/Edit', compact('shippingMethod'));
    }

    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod): RedirectResponse
    {
        $shippingMethod->update(["name" => $request->name]);

        return to_route('admin.shipping-methods.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, ShippingMethod $shippingMethod): RedirectResponse
    {
        $shippingMethod->delete();

        return to_route('admin.shipping-methods.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ShippingMethod::whereIn('id', $selectedItems)->delete();

        return to_route('admin.shipping-methods.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedShippingMethods = ShippingMethod::search(request('search'))
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/ShippingMethods/Trash', compact('trashedShippingMethods'));
    }

    public function restore(Request $request, int $trashedShippingMethodId): RedirectResponse
    {
        $trashedShippingMethod = ShippingMethod::onlyTrashed()->findOrFail($trashedShippingMethodId);

        $trashedShippingMethod->restore();

        return to_route('admin.shipping-methods.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        ShippingMethod::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.shipping-methods.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedShippingMethodId): RedirectResponse
    {
        $trashedShippingMethod = ShippingMethod::onlyTrashed()->findOrFail($trashedShippingMethodId);

        $trashedShippingMethod->forceDelete();

        return to_route('admin.shipping-methods.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedShippingMethods = ShippingMethod::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedShippingMethodsAction())->handle($trashedShippingMethods);

        return to_route('admin.shipping-methods.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedShippingMethods = ShippingMethod::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedShippingMethodsAction())->handle($trashedShippingMethods);

        return to_route('admin.shipping-methods.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
