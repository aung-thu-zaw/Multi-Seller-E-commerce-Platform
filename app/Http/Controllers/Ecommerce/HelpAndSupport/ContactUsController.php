<?php

namespace App\Http\Controllers\Ecommerce\HelpAndSupport;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Response;
use Inertia\ResponseFactory;

class ContactUsController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        return inertia('E-commerce/HelpAndSupport/Contact');
    }

    public function sendEmail(Request $request): RedirectResponse
    {
        Mail::to(env('MAIL_FROM_ADDRESS'))->queue(new ContactUsMail($request->name, $request->email, $request->phone, $request->messageDetail));

        return back()->with('success', 'Your email was sent successfully.');
    }
}
