<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Seller\AttributeAndOptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class AttributeAndOptionController extends Controller
{
    public function attributeAndOptions(Product $product): Response|ResponseFactory
    {
        $product->load(['attributes.options']);

        return inertia('Seller/Products/AttributeAndOptions', compact('product'));
    }

    public function handleAttributeAndOptions(AttributeAndOptionRequest $request, Product $product): RedirectResponse
    {
        $attribute = Attribute::firstOrCreate(['product_id' => $product->id, 'name' => $request->attribute]);

        foreach ($request->options as $option) {
            Option::firstOrCreate([
                'attribute_id' => $attribute->id,
                'value' => $option,
            ]);
        }

        return back()->with('success', 'Attributes and options has been successfully created.');
    }

    public function destroyAttributeAndOptions(Attribute $attribute): RedirectResponse
    {
        $attribute->delete();

        return back()->with('success', 'Attributes and options has been successfully deleted.');
    }

}
