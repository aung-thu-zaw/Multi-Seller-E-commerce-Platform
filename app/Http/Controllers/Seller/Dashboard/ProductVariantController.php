<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Product;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductVariantController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(Product $product): Response|ResponseFactory
    {
        $product->load(['attributes.options:id,attribute_id,value']);

        return inertia('Seller/Products/Variants/Index', compact('product'));
    }
}
