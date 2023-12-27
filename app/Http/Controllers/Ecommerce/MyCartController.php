<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\CartItemRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class MyCartController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $cart = Cart::firstOrCreate(["user_id" => auth()->id()]);

        $cartItems = $cart->cartItems()->with(['product.store:id,store_name,slug'])->get();

        // $myWishlists = Wishlist::with('product:id,store_id,name,image,qty,price,offer_price', 'store:id,store_name,slug')->where('user_id', auth()->id())->get();

        return inertia("E-commerce/MyCart/Index", compact("cartItems"));
    }
}
