<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\ReturnAndCancellationItemRequest;
use App\Mail\Seller\NewCancellationRequestEmail;
use App\Models\CancellationItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RequestCancellationItemController extends Controller
{
    public function __invoke(ReturnAndCancellationItemRequest $request, OrderItem $orderItem): RedirectResponse
    {
        $existingCancellation = CancellationItem::where('order_item_id', $orderItem->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingCancellation) {
            return back()->with('error', 'You have already submitted a cancellation request for this item.');
        }

        $cancellationItem = CancellationItem::create([
            'uuid' => Str::uuid(),
            'order_item_id' => $orderItem->id,
            'user_id' => auth()->id(),
            'reason' => $request->reason,
            'qty' => $request->qty,
            'unit_price' => $orderItem->unit_price,
            'total_price' => $request->qty * $orderItem->unit_price,
            'status' => 'pending',
        ]);

        $order = $orderItem->order;
        $store = Store::find($orderItem->store_id);
        $seller = User::find($store->seller_id);
        $user = auth()->user();

        Mail::to($store->contact_email)->queue(new NewCancellationRequestEmail($seller->name, $user->name, $order->tracking_no, $request->reason, $orderItem, $cancellationItem));

        return back()->with('success', 'Your request is successfully submitted.');
    }
}
