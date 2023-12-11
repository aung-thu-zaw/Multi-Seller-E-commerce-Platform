<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ChangePasswordController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia("User/ChangePassword");
    }
}
