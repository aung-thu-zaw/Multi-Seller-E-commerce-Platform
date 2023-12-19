<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\WishlistRequest;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(WishlistRequest $request): RedirectResponse
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->where('store_id', $request->store_id)
            ->first();

        if (!$wishlist) {
            $wishlist = Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'store_id' => $request->store_id,
            ]);

            return back()->with("success", "Item is moved to wishlist, you can re-add it to cart from wishlist.");
        } else {

            $wishlist->delete();

            return back()->with('success', 'Item has been removed from your wishlist');
        }
    }

}
