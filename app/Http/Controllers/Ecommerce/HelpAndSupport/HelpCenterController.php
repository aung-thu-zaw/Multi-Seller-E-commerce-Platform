<?php

namespace App\Http\Controllers\Ecommerce\HelpAndSupport;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class HelpCenterController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('E-commerce/HelpAndSupport/HelpCenter');
    }
}
