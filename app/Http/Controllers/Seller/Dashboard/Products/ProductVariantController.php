<?php

namespace App\Http\Controllers\Seller\Dashboard\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\Products\ProductVariantRequest;
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

    public function index(Product $product): Response|ResponseFactory
    {
        $productVariants = ProductVariant::search(request('search'))
            ->query(function (Builder $builder) {
                $builder->with('product:id,name');
            })
            ->orderBy(request('sort', 'id'), request('direction', 'desc'))
            ->paginate(request('per_page', 5))
            ->appends(request()->all());

        return inertia('Seller/Products/Variants/Index', compact('product', 'productVariants'));
    }

    public function create(Product $product): Response|ResponseFactory
    {
        return inertia('Seller/Products/Variants/Create', compact('product'));
    }

    public function store(ProductVariantRequest $request, Product $product): RedirectResponse
    {
        ProductVariant::create([
            'product_id' => $request->product_id,
            'sku' => $product->generateUniqueSku(),
            'qty' => $request->qty,
            'price' => $request->price,
            'discount' => $request->discount,
            'discount_start_date' => $request->discount_start_date,
            'discount_end_date' => $request->discount_end_date,
        ]);

        return to_route('seller.product-variants.index', $this->getQueryStringParams($request) + ['product' => $product->slug])->with('success', ':label has been successfully created.');
    }
}
