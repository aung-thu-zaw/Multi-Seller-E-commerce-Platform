<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\WishlistRequest;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;

class WishlistController extends Controller
{
    public function store(WishlistRequest $request): RedirectResponse
    {
        $attributes = isset($request->validated()['attributes'])
            ? (is_array($request->validated()['attributes'])
                ? json_encode($request->validated()['attributes'])
                : $request->validated()['attributes'])
            : null;

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->where('store_id', $request->store_id)
            ->where(function ($query) use ($attributes) {
                $query->whereJsonContains('attributes', json_decode($attributes, true) ?? null)
                    ->orWhere('attributes', null);
            })
            ->first();

        if (! $wishlist) {
            $wishlist = Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'store_id' => $request->store_id,
                'attributes' => $attributes,
            ]);

            return back()->with('success', 'Item is moved to the wishlist; you can re-add it to the cart from the wishlist.');
        } else {
            $wishlist->delete();

            return back()->with('success', 'Item has been removed from your wishlist.');
        }
    }

    public function destroy(Wishlist $wishlist): RedirectResponse
    {
        $wishlist->delete();

        return back()->with('success', 'Item has been removed from your wishlist');
    }
}
