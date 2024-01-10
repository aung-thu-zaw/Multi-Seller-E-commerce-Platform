<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteProductImageController extends Controller
{
    public function __invoke(ProductImage $productImage): RedirectResponse
    {
        ProductImage::deleteImage($productImage->image);

        $productImage->delete();

        return back()->with('success', 'Product image has been successfully deleted.');
    }
}
