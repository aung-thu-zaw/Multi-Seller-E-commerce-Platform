<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Inertia\Response;
use Inertia\ResponseFactory;

class MyOrderController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $orders = Order::with('orderItems.product:id,image,name,slug')->where('user_id', auth()->id())->orderBy('id', 'desc')->paginate(5)->withQueryString();

        return inertia('User/MyOrders/Index', compact('orders'));
    }

    public function show(Order $order): Response|ResponseFactory
    {
        $order->load(['orderItems.store:id,store_name', 'orderItems.product:id,store_id,image,name,slug', 'orderItems.cancellationItem:id,order_item_id,status', 'orderItems.returnItem:id,order_item_id,status']);

        return inertia('User/MyOrders/Show', compact('order'));
    }
}
