<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class MyAccountController extends Controller
{
    public function edit(): Response|ResponseFactory
    {
return inertia("User");
    }

    public function update(): RedirectResponse
    {

    }
}
