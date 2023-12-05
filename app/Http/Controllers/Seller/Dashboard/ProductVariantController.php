<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\ProductVariantRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductVariantController extends Controller
{
    use HandlesQueryStringParameters;

    public function productVariants(Product $product): Response|ResponseFactory
    {
        $product->load('productVariants');

        return inertia('Seller/Products/Variants', compact('product'));
    }
}
