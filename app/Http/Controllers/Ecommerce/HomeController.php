<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('E-commerce/Products/Details');
    }
    // public function __invoke(): View
    // {
    //     return view('mails.seller.store-activation');
    // }
}
