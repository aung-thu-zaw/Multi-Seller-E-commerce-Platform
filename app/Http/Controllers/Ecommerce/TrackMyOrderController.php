<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrackMyOrderController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $order = Order::where("tracking_no", $request->tracking_no)->where("user_id", auth()->id())->first();

        if(!$order) {
            return back()->with("error", "Order Code is invalid.");
        }

        return to_route("user.my-orders.show", ["order" => $order->uuid]);
    }
}
