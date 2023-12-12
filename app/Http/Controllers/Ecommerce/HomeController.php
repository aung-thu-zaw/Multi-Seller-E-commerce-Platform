<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class HomeController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia("E-commerce/Home");
    }
}
