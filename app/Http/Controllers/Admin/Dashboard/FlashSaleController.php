<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use App\Rules\RecaptchaRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Response;
use Inertia\ResponseFactory;

class FlashSaleController extends Controller
{
    public function edit(): Response|ResponseFactory
    {
        $flashSale = FlashSale::find(1);

        $flashSaleProducts = $flashSale->products()->select('id', 'image', 'name')->paginate(10);

        $products = Product::select("id", "name")
        ->where("status", "approved")
        ->whereDoesntHave('flashSales', function ($query) use ($flashSale) {
            $query->where('flash_sale_id', $flashSale->id);
        })
        ->get();

        return inertia("Admin/FlashSales/Edit", compact("flashSale", "products", "flashSaleProducts"));
    }

    public function update(Request $request, FlashSale $flashSale): RedirectResponse
    {
        $request->validate([
            "end_date" => ["nullable","date"],
            "captcha_token"  => [new RecaptchaRule()],
        ]);

        $flashSale->update(["end_date" => $request->end_date]);

        return back()->with('success', ':label has been successfully updated.');
    }

    public function addProduct(Request $request, FlashSale $flashSale): RedirectResponse
    {
        $request->validate([
            "product_id" => ["required","numeric",Rule::exists("products", "id")]
        ]);

        $flashSale->products()->attach($request->product_id);

        return back()->with("success", "Product successfully added to this flash sale.");
    }

    public function removeProduct(Request $request, FlashSale $flashSale): RedirectResponse
    {
        $request->validate([
            "product_id" => ["required","numeric",Rule::exists("products", "id")]
        ]);

        $flashSale->products()->detach($request->product_id);

        return back()->with("success", "Product successfully removed to this flash sale.");
    }
}
