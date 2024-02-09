<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeToNewsletter;
use App\Models\Subscriber;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class SubscribeNewsLetterController extends Controller
{
    public function subscribe(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', Rule::unique('subscribers', 'email')],
            'captcha_token' => [new RecaptchaRule()],
        ]);

        $subscriber = Subscriber::create(['email' => $request->email, 'status' => 'subscribed']);

        Mail::to($subscriber->email)->queue(new WelcomeToNewsletter());

        return back()->with('success', 'Thank you for subscribing our news letters.');
    }

    public function unsubscribe(Subscriber $subscriber): RedirectResponse
    {
        $subscriber->update(['status' => 'unsubscribed']);

        return back();
    }
}
