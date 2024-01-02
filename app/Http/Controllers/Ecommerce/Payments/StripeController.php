<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Http\Traits\Payment;
use App\Models\Address;
use App\Models\ShippingMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Charge;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripeController extends Controller
{
    use Payment;

    public function payWithStripe(Request $request): RedirectResponse
    {
        $cartItems = auth()->user()->cart->cartItems;
        $shippingMethod = ShippingMethod::find($cartItems[0]->shipping_method_id);
        $address = Address::where('user_id', auth()->id())
            ->where('is_default_delivery', 1)
            ->first();

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $productsByStore = [];

        try {
            $response = PaymentIntent::create([
                'amount' => $request->total_amount * 100,
                'currency' => 'usd',
                'description' => 'product purchase!',
                'payment_method' => $request->payment_method_id,
                'confirm' => true,
                'metadata' => [
                    'order_id' => '#'.uniqid(),
                ],
                'return_url' => env('APP_URL'),
            ]);

            $balanceTransaction = Charge::retrieve($response->latest_charge)->balance_transaction;

            if ($response->status === 'succeeded') {
                $order = $this->processOrder(
                    'card',
                    $balanceTransaction,
                    $cartItems,
                    $shippingMethod,
                    $address,
                    $request->total_amount,
                    $request->shipping_fee,
                    $productsByStore,
                    'paid'
                );

                $this->sendOrderConfirmationEmails($address, $order, $productsByStore);

                return to_route('home')->with('success', 'Your order placed is successfully.');
            } else {
                return back()->with('Something went wrong!');
            }
        } catch (\Exception $e) {
            Log::error('Stripe Error: '.$e->getMessage());
        }

        return back();
    }
}
