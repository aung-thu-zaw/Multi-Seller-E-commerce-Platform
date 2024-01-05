<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Symfony\Component\HttpFoundation\RedirectResponse;

class GoogleAuthController extends Controller
{
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver("google")->redirect();
    }

    public function handelProviderCallback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver("google")->user();
        } catch(InvalidStateException $e) {
            return redirect()->back()->with("status", "Something Went Wrong!");
        }

        $existingUser = User::where("google_id", $googleUser->getId())->first();


        if (!$existingUser) {
            $newUser = User::create([
                "google_id" => $googleUser->getId(),
                "name" => $googleUser->getName(),
                "email" => $googleUser->getEmail(),
                "avatar" => $googleUser->getAvatar(),
                "role" => "user",
                "email_verified_at" => now(),
            ]);

            event(new Registered($newUser));

            Auth::login($newUser);

        } else {

            Auth::login($existingUser);
        }

        return back();
    }
}
