<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class DashboardController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('Admin/Dashboard');
    }
}
