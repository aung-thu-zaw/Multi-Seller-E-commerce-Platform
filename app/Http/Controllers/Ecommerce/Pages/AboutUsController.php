<?php

namespace App\Http\Controllers\Ecommerce\Pages;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class AboutUsController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('E-commerce/Pages/AboutUs');
    }
}
