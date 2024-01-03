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
        $order->load(["orderItems.product:id,name,image",'orderItems.store:id,store_name','transaction','address']);

        return inertia('Admin/OrderManagement/Orders/Show', compact('order'));
    }

    // public function updateOrderStatus(Request $request, Order $order): RedirectResponse
    // {
    //     $order->update(["status" => $request->order_status]);

    //     if($request->order_status === 'shipped' || $request->order_status === 'delivered') {
    //         $order->orderItems->each(function ($item) use ($request) {
    //             $item->update(["status" => $request->order_status]);
    //         });
    //     }

    //     return back()->with('success', ':label has been successfully updated.');
    // }

    public function updateOrderStatus(Request $request, Order $order): RedirectResponse
    {
        if ($request->order_status === 'shipped' || $request->order_status === 'delivered') {
            $isReadyToShip = $order->orderItems->every(function ($item) {
                return $item->status === 'ready to ship' || $item->status === 'shipped';
            });

            if ($isReadyToShip) {
                $order->update(['status' => $request->order_status]);

                $order->orderItems->each(function ($item) use ($request) {
                    $item->update(['status' => $request->order_status]);
                });

                return back()->with('success', ':label has been successfully updated.');
            } else {
                return back()->with('error', 'Cannot update order status. All order items must be "ready to ship".');
            }
        } else {
            $order->update(['status' => $request->order_status]);

            return back()->with('success', ':label has been successfully updated.');
        }
    }



    // public function updateOrderStatus(Request $request, Order $order): RedirectResponse
    // {
    //     $storeId = Store::getStoreId();

    //     $orderItems = OrderItem::where("order_id", $order->id)->where("store_id", $storeId)->get();

    //     if ($request->order_status === 'shipped' || $request->order_status === 'delivered') {
    //         $isReadyToShip = $orderItems->every(function ($item) {
    //             return $item->status === 'ready to ship';
    //         });

    //         if ($isReadyToShip) {
    //             $order->update(['status' => $request->order_status]);

    //             $orderItems->each(function ($item) use ($request) {
    //                 $item->update(['status' => $request->order_status]);
    //             });

    //             return back()->with('success', ':label has been successfully updated.');
    //         } else {
    //             return back()->with('error', 'Cannot update order status. All order items must be "ready to ship".');
    //         }
    //     } else {
    //         $order->update(['status' => $request->order_status]);

    //         return back()->with('success', ':label has been successfully updated.');
    //     }
    // }

    public function updatePaymentStatus(Request $request, Order $order): RedirectResponse
    {
        if($order->payment_method === 'cash on delivery' && $request->payment_status === 'completed') {

            $order->update(["payment_status" => $request->payment_status,"purchased_at" => now()]);
        }

        return back()->with('success', ':label has been successfully updated.');
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
