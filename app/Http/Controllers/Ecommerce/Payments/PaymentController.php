<?php

namespace App\Http\Controllers\Ecommerce\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class PaymentController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia("E-commerce/Payments/Index");
    }
}
