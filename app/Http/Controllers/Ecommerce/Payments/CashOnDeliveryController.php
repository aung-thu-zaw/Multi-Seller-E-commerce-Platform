<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Http\Traits\Payment;
use App\Models\Address;
use App\Models\ShippingMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CashOnDeliveryController extends Controller
{
    use Payment;

    public function payWithCash(Request $request): RedirectResponse
    {
        $cartItems = auth()->user()->cart->cartItems;
        $shippingMethod = ShippingMethod::find($cartItems[0]->shipping_method_id);
        $address = Address::where('user_id', auth()->id())
            ->where('is_default_delivery', 1)
            ->first();

        $productsByStore = [];

        try {
            $order = $this->processOrder(
                'cash on delivery',
                null,
                $cartItems,
                $shippingMethod,
                $address,
                $request->total_amount,
                $request->shipping_fee,
                $productsByStore
            );

            $this->sendOrderConfirmationEmails($address, $order, $productsByStore);

            return to_route('home')->with('success', 'Your order placed is successfully.');
        } catch (\Exception $e) {
            Log::error('Cash on Delivery Error: '.$e->getMessage());
        }

        return back();
    }
}
