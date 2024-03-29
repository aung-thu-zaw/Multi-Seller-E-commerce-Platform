<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\CartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function store(CartItemRequest $request): RedirectResponse
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $attributes = $request->validated()['attributes'];

        $cartItem = CartItem::where('product_id', $request->product_id)
            ->where(function ($query) use ($attributes) {
                $query->whereJsonContains('attributes', $attributes)
                    ->orWhere('attributes', null);
            })
            ->first();

        if ($cartItem) {

            $cartItem->update(['qty' => $cartItem->qty + $request->qty, 'total_price' => $cartItem->total_price + $request->total_price]);

        } else {

            CartItem::create([
                'shipping_method_id' => 1,
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'store_id' => $request->store_id,
                'qty' => $request->qty,
                'unit_price' => $request->unit_price,
                'total_price' => $request->total_price,
                'attributes' => is_array($attributes) ? json_encode($attributes) : $attributes,
            ]);
        }

        return back()->with('success', "$request->qty item(s) have been added to your cart");
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $cartItem->update([
            'qty' => $request->qty,
            'total_price' => $request->total_price,
        ]);

        return back();
    }

    public function destroy(CartItem $cartItem): RedirectResponse
    {
        $cartItem->delete();

        return back()->with('success', "$cartItem->qty item(s) have been removed from your cart");
    }
}
