<?php

namespace App\Http\Controllers\Seller\Dashboard\Products;

use App\Http\Controllers\Controller;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductVariantController extends Controller
{
    use HandlesQueryStringParameters;

    public function index(Product $product): Response|ResponseFactory
    {
        $productVariants = ProductVariant::search(request('search'))
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/Products/Variants/Index', compact('product', 'productVariants'));
    }
}
