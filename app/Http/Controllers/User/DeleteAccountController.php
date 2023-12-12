<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class DeleteAccountController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        return inertia('User/DeleteAccount');
    }
}
