<?php

namespace App\Http\Controllers\Seller\Dashboard\OrderManagement;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class OrderController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $storeId = Store::getStoreId();

        $orders = Order::search(request('search'))
            ->query(function (Builder $builder) use ($storeId) {
                $builder->with([
                    'user:id,name',
                    'orderItems' => function ($query) use ($storeId) {
                        $query->where('store_id', $storeId);
                        // ->with(['product:id,name,image', 'store:id,store_name']);
                    },
                ]);
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/OrderManagement/Orders/Index', compact('orders'));
    }

    public function show(Order $order): Response|ResponseFactory
    {
        $storeId = Store::getStoreId();

        $order->load([
            'orderItems' => function ($query) use ($storeId) {
                $query->where('store_id', $storeId)
                    ->with(['product:id,name,image', 'store:id,store_name']);
            },
            'transaction',
            'address',
        ]);

        return inertia('Seller/OrderManagement/Orders/Show', compact('order'));
    }

    public function updateOrderStatus(Request $request, Order $order): RedirectResponse
    {
        $storeId = Store::getStoreId();

        if ($order->status !== 'shipped' && $order->status !== 'delivered') {
            $orderItems = OrderItem::where('order_id', $order->id)->where('store_id', $storeId)->get();

            $orderItems->each(function ($item) use ($request) {
                if ($request->order_status === 'shipped' || $request->order_status === 'delivered') {
                    return back()->with('error', 'Cannot update order item status. Order status is already "shipped" or "delivered".');
                }

                $item->update(['status' => $request->order_status]);
            });

            return back()->with('success', ':label has been successfully updated.');
        } else {
            return back()->with('error', 'Cannot update order item status. Order status is already "shipped" or "delivered".');
        }
    }
}
