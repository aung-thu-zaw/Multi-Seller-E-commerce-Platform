<?php

namespace App\Http\Controllers\Seller\Dashboard\OrderManagement;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\CancellationItem;
use App\Models\OrderItem;
use App\Models\Store;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CancelItemController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(): Response|ResponseFactory
    {
        $storeId = Store::getStoreId();

        $cancellationItems = CancellationItem::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with(['orderItem.product:id,name,image','orderItem.order.user:id,name']);
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/OrderManagement/CancellationItems/Index', compact('cancellationItems'));
    }

    public function show(CancellationItem $cancellationItem): Response|ResponseFactory
    {
        return inertia('Seller/OrderManagement/CancellationItems/Show', compact('cancellationItem'));
    }

    // public function updateOrderStatus(Request $request, Order $order): RedirectResponse
    // {
    //     $storeId = Store::getStoreId();

    //     if ($order->status !== 'shipped' && $order->status !== 'delivered') {
    //         $orderItems = OrderItem::where("order_id", $order->id)->where("store_id", $storeId)->get();

    //         $orderItems->each(function ($item) use ($request) {
    //             if ($request->order_status === 'shipped' || $request->order_status === 'delivered') {
    //                 return back()->with('error', 'Cannot update order item status. Order status is already "shipped" or "delivered".');
    //             }

    //             $item->update(['status' => $request->order_status]);
    //         });

    //         return back()->with('success', ':label has been successfully updated.');
    //     } else {
    //         return back()->with('error', 'Cannot update order item status. Order status is already "shipped" or "delivered".');
    //     }
    // }
}
