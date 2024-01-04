<?php

namespace App\Http\Controllers\Seller\Dashboard\ProductManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class ProductImageController extends Controller
{
    public function productImages(Product $product): Response|ResponseFactory
    {
        $product->load('productImages');

        return inertia('Seller/ProductManage/ProductImages', compact('product'));
    }

    public function handleProductImages(ProductImageRequest $request, Product $product): RedirectResponse
    {
        foreach ($request->images as $image) {
            $originalName = $image->getClientOriginalName();

            $fileName = time().'-'.$originalName;

            $image->storeAs('products', $fileName);

            ProductImage::create(['product_id' => $product->id, 'image' => $fileName]);
        }

        return back()->with('success', 'Product images has been successfully created.');
    }

    public function destroyProductImage(ProductImage $productImage): RedirectResponse
    {
        ProductImage::deleteImage($productImage->image);

        $productImage->delete();

        return back()->with('success', 'Product image has been successfully deleted.');
    }
}
