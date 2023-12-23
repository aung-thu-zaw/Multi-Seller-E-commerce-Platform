<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\SearchHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateSearchHistoryController extends Controller
{
    public function __invoke(SearchHistory $searchHistory): RedirectResponse
    {
        $searchHistory->update(["user_id" => null]);

        return back();
    }
}
