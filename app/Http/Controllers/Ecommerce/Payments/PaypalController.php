<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function config(): array
    {
        return [
            'mode' => env('PAYPAL_MODE', 'sandbox'),
            'sandbox' => [
                'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
                'client_secret' => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
                'app_id' => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id' => env('PAYPAL_LIVE_CLIENT_ID', ''),
                'client_secret' => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
                'app_id' => env('PAYPAL_LIVE_APP_ID', ''),
            ],

            'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'),
            'currency' => env('PAYPAL_CURRENCY', 'USD'),
            'notify_url' => env('PAYPAL_NOTIFY_URL', ''),
            'locale' => env('PAYPAL_LOCALE', 'en_US'),
            'validate_ssl' => env('PAYPAL_VALIDATE_SSL', true),
        ];
    }
    public function payWithPaypal()
    {
        try {
            $config = $this->config();

            $provider = new PayPalClient($config);

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
                            'currency_code' => $config["currency"],
                            'value' => 250.89,
                            // "value" => $request->price
                        ],
                    ],
                ],
            ]);

            if (isset($response["id"]) && $response["id"] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        // dd($link['href']);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('payments.paypal.cancel');
            }
        } catch (Exception $e) {
            Log::error('PayPal API Error: ' . $e->getMessage());

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function paypalSuccess(Request $request)
    {
        $config = $this->config();

        $provider = new PayPalClient($config);

        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response["status"]) && $response["status"] === "COMPLETED") {
            dd("Paid Successfully");
        }

        return to_route("payments.paypal.cancel");
    }

    public function paypalCancel(Request $request)
    {
        return to_route('payments.index')->with("error", "Something went wrong!");
    }
}
