<?php

namespace App\Http\Controllers\Ecommerce\HelpAndSupport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ContactUsController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia("E-commerce/HelpAndSupport/Contact");
    }
}
