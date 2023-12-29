<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class ChangeLanguageController extends Controller
{
    public function __invoke(Request $request): RedirectResponse
    {
        $changeLanguage = $request->language;

        $allowedLanguages = config('app.languages');

        if (array_key_exists($changeLanguage, $allowedLanguages)) {
            Cache::flush();
            session()->put('language', $changeLanguage);
        }

        return back();
    }
}
