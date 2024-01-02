<?php

namespace App\Http\Controllers\Admin\Dashboard\OrderManagement;

use App\Actions\Admin\OrderManagement\PermanentlyDeleteTrashedOrdersAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\OrderManagement\OrderRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class OrderController extends Controller
{
    use HandlesQueryStringParameters;

    public function __construct()
    {
        $this->middleware('permission:brands.view', ['only' => ['index']]);
        $this->middleware('permission:brands.edit', ['only' => ['update']]);
        $this->middleware('permission:brands.delete', ['only' => ['destroy', 'destroySelected']]);
        $this->middleware('permission:brands.view.trash', ['only' => ['trashed']]);
        $this->middleware('permission:brands.restore', ['only' => ['restore', 'restoreSelected']]);
        $this->middleware('permission:brands.force.delete', ['only' => ['forceDelete', 'forceDeleteSelected', 'forceDeleteAll']]);
    }

    public function index(): Response|ResponseFactory
    {
        $orders = Order::search(request('search'))
        ->query(function (Builder $builder) {
            $builder->with(["user:id,name"]);
        })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/OrderManagement/Orders/Index', compact('orders'));
    }

    public function show(Order $order): Response|ResponseFactory
    {
        $order->load(["orderItems.product:id,name,image",'orderItems.store:id,store_name']);

        return inertia('Admin/OrderManagement/Orders/Show', compact('order'));
    }

    public function update(OrderRequest $request, Order $order): RedirectResponse
    {
        // (new UpdateBrandAction())->handle($request->validated(), $brand);

        return to_route('admin.orders.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully updated.');
    }

    public function destroy(Request $request, Order $order): RedirectResponse
    {
        $order->delete();

        return to_route('admin.orders.index', $this->getQueryStringParams($request))->with('success', ':label has been successfully deleted.');
    }

    public function destroySelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Order::whereIn('id', $selectedItems)->delete();

        return to_route('admin.orders.index', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully deleted.');
    }

    public function trashed(): Response|ResponseFactory
    {
        $trashedOrders = Order::search(request('search'))
        ->query(function (Builder $builder) {
            $builder->with(["user:id,name"]);
        })
            ->onlyTrashed()
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Admin/OrderManagement/Orders/Trash', compact('trashedOrders'));
    }

    public function restore(Request $request, int $trashedOrderId): RedirectResponse
    {
        $trashedOrder = Order::onlyTrashed()->findOrFail($trashedOrderId);

        $trashedOrder->restore();

        return to_route('admin.orders.trashed', $this->getQueryStringParams($request))->with('success', ':label has been successfully restored.');
    }

    public function restoreSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        Order::onlyTrashed()
            ->whereIn('id', $selectedItems)
            ->restore();

        return to_route('admin.orders.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been successfully restored.');
    }

    public function forceDelete(Request $request, int $trashedOrderId): RedirectResponse
    {
        $trashedOrder = Order::onlyTrashed()->findOrFail($trashedOrderId);

        $trashedOrder->forceDelete();

        return to_route('admin.orders.trashed', $this->getQueryStringParams($request))->with('success', 'The :label has been permanently deleted.');
    }

    public function forceDeleteSelected(Request $request, string $selectedItems): RedirectResponse
    {
        $selectedItems = explode(',', $selectedItems);

        $trashedOrders = Order::onlyTrashed()->whereIn('id', $selectedItems)->get();

        (new PermanentlyDeleteTrashedOrdersAction())->handle($trashedOrders);

        return to_route('admin.orders.trashed', $this->getQueryStringParams($request))->with('success', 'Selected :label have been permanently deleted.');
    }

    public function forceDeleteAll(Request $request): RedirectResponse
    {
        $trashedOrders = Order::onlyTrashed()->get();

        (new PermanentlyDeleteTrashedOrdersAction())->handle($trashedOrders);

        return to_route('admin.orders.trashed', $this->getQueryStringParams($request))->with('success', 'All :label have been permanently deleted.');
    }
}
