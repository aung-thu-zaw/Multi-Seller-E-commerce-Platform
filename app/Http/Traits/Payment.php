<?php

namespace App\Http\Traits;

use App\Mail\Admin\NewOrderPlacedEmail;
use App\Mail\Seller\NewOrderPlacedEmail as SellerNewOrderPlacedEmail;
use App\Mail\User\OrderPlacedSuccessfullyEmail;
use App\Models\Address;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SellerBalance;
use App\Models\ShippingMethod;
use App\Models\Sku;
use App\Models\Store;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

trait Payment
{
    /**
     * @param  Collection<int,CartItem>  $cartItems
     * @param  array<Store>  $productsByStore
     */
    public function processOrder(string $paymentMethod, ?string $transaction_id, Collection $cartItems, ShippingMethod $shippingMethod, Address $address, float|int $totalAmount, float|int $shippingRate, array $productsByStore, string $paymentStatus = 'pending'): Order
    {
        return DB::transaction(function () use ($paymentMethod, $transaction_id, $cartItems, $shippingMethod, $address, $totalAmount, $shippingRate, &$productsByStore, $paymentStatus) {
            $order = Order::create([
                'uuid' => Str::uuid(),
                'user_id' => auth()->id(),
                'invoice_no' => 'E-COMMERCE'.mt_rand(100000000, 999999999),
                'tracking_no' => '#'.uniqid(),
                'product_qty' => $cartItems->sum('qty'),
                'payment_method' => $paymentMethod,
                'purchased_at' => $paymentStatus === 'completed' && $paymentMethod !== 'cash on delivery' ? now() : null,
                'payment_status' => $paymentStatus,
                'total_amount' => $totalAmount,
                'address_id' => $address->id,
                'shipping_method' => $shippingMethod->name,
                'shipping_fee' => $shippingRate,
                'coupon_type' => session('coupon') ? session('coupon')['type'] : null,
                'coupon_amount' => session('coupon') ? session('coupon')['value'] : null,
                'status' => 'pending',
            ]);

            $cartItems->each(function ($item) use ($order, &$productsByStore) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'store_id' => $item->store_id,
                    'qty' => $item->qty,
                    'attributes' => $item->attributes,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price,
                    'status' => 'pending',
                ]);

                $productsByStore[$item->store_id][] = $orderItem;

                // Update Product Qty
                if ($item->attributes) {
                    $attributes = json_decode($item->attributes, true);

                    $sku = $this->getSkuByAttributes($item->product_id, $attributes);

                    if ($sku) {
                        $sku->update(['qty' => $sku->qty - $item->qty]);
                    }
                } else {
                    $product = Product::find($item->product_id);

                    if ($product) {
                        $product->update(['qty' => $product->qty - $item->qty]);
                    }
                }

                // Add Balance To Seller
                $store = Store::find($item->store_id);
                
                SellerBalance::updateOrCreate(
                    ['seller_id' => $store->seller_id],
                    ['balance' => DB::raw("balance + $item->total_price")]
                );

            });

            Transaction::create([
                'order_id' => $order->id,
                'transaction_id' => $transaction_id,
                'related_type' => 'order',
                'payment_method' => $paymentMethod,
                'amount' => $totalAmount,
            ]);

            if (session('coupon')) {
                session()->forget('coupon');
            }

            $cartItems->each(function ($item) {
                $item->destroy($item->id);
            });

            return $order;
        });
    }

    /**
     * @param  array<Store>  $productsByStore
     */
    public function sendOrderConfirmationEmails(Address $address, Order $order, array $productsByStore): void
    {
        $order->load(['user:id,name', 'orderItems.product:id,image,name']);

        Mail::to($address->email)->queue(new OrderPlacedSuccessfullyEmail($address, $order));

        $admins = User::where('role', 'admin')
            ->permission(['orders.edit'])
            ->get();

        $admins->each(function ($admin) use ($address, $order) {
            Mail::to($admin->email)->queue(new NewOrderPlacedEmail($admin, $address, $order));
        });

        foreach ($productsByStore as $storeId => $orderItems) {
            $store = Store::with('seller:id,name')->find($storeId);

            Mail::to($store->contact_email)->queue(new SellerNewOrderPlacedEmail($store, $address, $orderItems));

        }
    }

    /**
     * @param  array<mixed>  $attributes
     */
    protected function getSkuByAttributes(int $productId, array $attributes): ?Sku
    {
        $attributeOptionIds = [];

        foreach ($attributes as $attributeName => $attributeValue) {
            $attributeId = Attribute::where('name', $attributeName)->value('id');

            $attributeOptionId = AttributeOption::where('attribute_id', $attributeId)
                ->where('value', $attributeValue)
                ->value('id');

            if ($attributeOptionId) {
                $attributeOptionIds[] = $attributeOptionId;
            }
        }

        if (! empty($attributeOptionIds)) {
            $sku = Sku::where('product_id', $productId)
                ->whereHas('attributeOptions', function ($query) use ($attributeOptionIds) {
                    $query->whereIn('attribute_option_id', $attributeOptionIds);
                })
                ->first();

            return $sku;
        }

        return null;
    }
}
