<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Inertia\Response;
use Inertia\ResponseFactory;

class AdminLoginController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('Admin/Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }
}
