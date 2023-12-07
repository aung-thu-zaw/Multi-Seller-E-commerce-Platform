<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\RedirectResponse;

class DeleteOptionController extends Controller
{
    public function __invoke(Option $option): RedirectResponse
    {
        $option->delete();

        return back()->with('success', 'Option has been successfully deleted.');
    }
}
