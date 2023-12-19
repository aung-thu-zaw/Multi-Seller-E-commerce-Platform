<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class MyWishlistController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $myWishlists = Wishlist::with("product:id,store_id,name,image,qty,price,offer_price", 'store:id,store_name,slug')->where("user_id", auth()->id())->get();

        return inertia('User/MyWishlists', compact("myWishlists"));
    }

    public function destroy(Wishlist $wishlist): RedirectResponse
    {
        $wishlist->delete();

        return back()->with('success', 'Item has been removed from your wishlist');
    }
}
