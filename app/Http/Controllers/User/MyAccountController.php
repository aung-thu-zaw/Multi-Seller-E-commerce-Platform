<?php

namespace App\Http\Controllers\User;

use App\Actions\User\MyAccount\UpdateMyAccountAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\MyAccountRequest;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class MyAccountController extends Controller
{
    public function edit(Request $request): Response|ResponseFactory
    {
        return inertia('User/MyAccount', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    public function update(MyAccountRequest $request, User $user): RedirectResponse
    {
        (new UpdateMyAccountAction())->handle($request->validated(), $user);

        return back()->with('success', ':label has been successfully updated.');
    }
}
