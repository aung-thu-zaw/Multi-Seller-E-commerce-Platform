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
        $cart = Cart::firstOrCreate(["user_id" => auth()->id()]);

        $cartItem = CartItem::where('product_id', $request->product_id)->whereJsonContains('attributes', $request->validated()['attributes'])->first();

        $attributes = is_array($request->validated()['attributes']) ? json_encode($request->validated()['attributes']) : $request->validated()['attributes'];

        if($cartItem) {

            $cartItem->update(["qty" => $cartItem->qty + $request->qty,'total_price' => $cartItem->total_price + $request->total_price]);

        } else {

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'total_price' => $request->total_price,
                'attributes' => $request->validated()['attributes'] ? $attributes : null,
            ]);
        }

        return back()->with("success", "$request->qty item(s) have been added to your cart");
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $cartItem->update([
            "qty" => $request->qty,
            "total_price" => $request->total_price
        ]);

        return back();
    }
    public function destroy(CartItem $cartItem): RedirectResponse
    {
        $cartItem->delete();

        return back()->with("success", "$cartItem->qty item(s) have been removed from your cart");
    }
}
