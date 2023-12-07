<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\HelpPageRequest;
use App\Models\HelpPage;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class HelpPageController extends Controller
{
    public function privacyAndPolicy(): Response|ResponseFactory
    {
        $privacyAndPolicy = HelpPage::where('title', 'Privacy And Policy')->first();

        return inertia('Admin/HelpPages/PrivacyAndPolicy', compact('privacyAndPolicy'));
    }

    public function TermsAndConditions(): Response|ResponseFactory
    {
        $termsAndConditions = HelpPage::where('title', 'Terms And Conditions')->first();

        return inertia('Admin/HelpPages/TermsAndConditions', compact('termsAndConditions'));
    }

    public function ReturnsAndRefunds(): Response|ResponseFactory
    {
        $returnsAndRefunds = HelpPage::where('title', 'Returns And Refunds')->first();

        return inertia('Admin/HelpPages/ReturnsAndRefunds', compact('returnsAndRefunds'));
    }

    public function update(HelpPageRequest $request, HelpPage $helpPage): RedirectResponse
    {
        $helpPage->update(['content' => $request->content]);

        return back()->with('success', ':label has been successfully updated.');
    }
}
