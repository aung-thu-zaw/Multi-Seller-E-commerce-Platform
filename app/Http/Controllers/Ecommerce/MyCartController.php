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
        $coupon = session("coupon") ?? null;

        return inertia("E-commerce/CartAndCheckout/MyCart", compact('coupon'));
    }
}
