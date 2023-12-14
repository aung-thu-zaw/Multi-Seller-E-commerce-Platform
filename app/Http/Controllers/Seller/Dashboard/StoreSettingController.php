<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class StoreSettingController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia("Seller/StoreSettings/Index");
    }
}
