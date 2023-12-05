<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\ProductVariantRequest;
use App\Http\Traits\HandlesQueryStringParameters;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductVariantController extends Controller
{
    use HandlesQueryStringParameters;

    public function productVariants(Product $product): Response|ResponseFactory
    {
        $product->load(['productVariants.attributes.options']);

        return inertia('Seller/Products/Variants', compact('product'));
    }

    public function handleProductVariant(ProductVariantRequest $request, Product $product): RedirectResponse
    {
        $attribute = Attribute::firstOrCreate(['product_id' => $product->id,'name' => $request->attribute]);

        foreach ($request->options as $option) {
            Option::firstOrCreate([
                         'attribute_id' => $attribute->id,
                         'value' => $option,
                     ]);
        }

        return back()->with('success', 'Product variant attributes and options added successfully.');
    }
}
