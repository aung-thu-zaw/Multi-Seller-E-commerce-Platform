<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use App\Http\Traits\CheckoutPayment;
use App\Http\Traits\Payment;
use App\Models\Address;
use App\Models\ShippingMethod;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    use CheckoutPayment;
    use Payment;

    public function payWithPaypal(): RedirectResponse
    {
        $coupon = session('coupon') ?? null;
        $cartItems = auth()->user()->cart->cartItems;
        $address = Address::where('user_id', auth()->id())->where('is_default_delivery', 1)->first();
        $shippingArea = $this->getShippingArea($address);
        $totalCartItemAmount = $this->calculateTotalCartItemAmount($cartItems, $coupon);
        $shippingRate = $this->getShippingRate($shippingArea, $cartItems, $totalCartItemAmount);

        try {
            $provider = new PayPalClient();

            $provider->setApiCredentials(config('paypal'));

            $provider->getAccessToken();

            $response = $provider->createOrder([
                'intent' => 'CAPTURE',
                'application_context' => [
                    'return_url' => route('payments.paypal.success'),
                    'cancel_url' => route('payments.paypal.cancel'),
                ],
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'USD',
                            'value' => $totalCartItemAmount + $shippingRate->rate,
                        ],
                    ],
                ],
            ]);

            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $links) {
                    if ($links['rel'] === 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
            } else {
                return redirect()->route('payments.paypal.cancel');
            }
        } catch (Exception $e) {
            Log::error('PayPal API Error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong!');
        }

        // Default return statement in case of unexpected scenarios
        return redirect()->route('payments.paypal.cancel');
    }

    public function paypalSuccess(Request $request): RedirectResponse
    {
        $coupon = session('coupon') ?? null;
        $cartItems = auth()->user()->cart->cartItems;
        $shippingMethod = ShippingMethod::find($cartItems[0]->shipping_method_id);
        $address = Address::where('user_id', auth()->id())->where('is_default_delivery', 1)->first();
        $shippingArea = $this->getShippingArea($address);
        $totalCartItemAmount = $this->calculateTotalCartItemAmount($cartItems, $coupon);
        $shippingRate = $this->getShippingRate($shippingArea, $cartItems, $totalCartItemAmount);

        $productsByStore = [];

        try {
            $provider = new PayPalClient(config('paypal'));

            $provider->getAccessToken();

            $response = $provider->capturePaymentOrder($request->token);

            if (isset($response['status']) && $response['status'] === 'COMPLETED') {
                $order = $this->processOrder(
                    'paypal',
                    $response['id'],
                    $cartItems,
                    $shippingMethod,
                    $address,
                    $totalCartItemAmount + $shippingRate->rate,
                    $shippingRate->rate,
                    $productsByStore,
                    'completed'
                );

                $this->sendOrderConfirmationEmails($address, $order, $productsByStore);

                return to_route('home')->with('success', 'Your order placed is successfully.');
            } else {
                return to_route('payments.paypal.cancel');
            }
        } catch (Exception $e) {
            Log::error('PayPal API Error: '.$e->getMessage());

            return back()->with('error', 'Something went wrong!');
        }
    }

    public function paypalCancel(Request $request): RedirectResponse
    {
        return to_route('payments')->with('error', 'Something went wrong!');
    }
}
