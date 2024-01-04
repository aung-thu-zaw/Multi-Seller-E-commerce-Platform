<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\ReturnAndCancellationItemRequest;
use App\Mail\Seller\NewReturnRequest;
use App\Models\OrderItem;
use App\Models\ReturnItem;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RequestReturnItemController extends Controller
{
    public function __invoke(ReturnAndCancellationItemRequest $request, OrderItem $orderItem): RedirectResponse
    {
        $existingReturn = ReturnItem::where('order_item_id', $orderItem->id)->where('user_id', auth()->id())->first();

        if ($existingReturn) {
            return back()->with("error", "You have already submitted a return request for this item.");
        }

        ReturnItem::create([
               "order_item_id" => $orderItem->id,
               "user_id" => auth()->id(),
               "reason" => $request->reason,
               "status" => "pending"
           ]);


        $order = $orderItem->order;
        $store = Store::find($orderItem->store_id);
        $seller = User::find($store->seller_id);
        $user = auth()->user();

        Mail::to($store->contact_email)->queue(new NewReturnRequest($seller->name, $user->name, $order->tracking_no, $request->reason, $orderItem));

        return back()->with("success", "Your request is successfully submitted.");
    }
}
