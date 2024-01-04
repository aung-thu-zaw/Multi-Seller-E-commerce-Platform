<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductViewRecordController extends Controller
{
    public function __invoke(Product $product): RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();

            if (!$user->viewedProducts->contains($product)) {
                $user->viewedProducts()->attach($product);
            }
        }

        return redirect()->route('products.show', ['product' => $product,'tab' => 'description']);
    }
}
