<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class CheckoutController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia("E-commerce/CartAndCheckout/Checkout");
    }
}
