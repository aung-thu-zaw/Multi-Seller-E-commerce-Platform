<?php

namespace App\Http\Controllers\User;

use App\Actions\User\MyReviews\CreateProductReviewAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\User\ProductReviewRequest;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class MyReviewController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        $productsToReview = Product::select('id', 'name', 'slug', 'store_id', 'image')
            ->with('store:id,seller_id,store_name')
            ->whereHas('orderItems', function ($query) {
                $query->whereHas('order', function ($orderQuery) {
                    $orderQuery->where('user_id', auth()->id())->where('status', 'delivered');
                });
            })
            ->whereDoesntHave('productReviews', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with([
                'orderItems' => function ($query) {
                    $query
                        ->with([
                            'order' => function ($orderQuery) {
                                $orderQuery
                                    ->where('user_id', auth()->id())
                                    ->where('status', 'delivered')
                                    ->select('id', 'tracking_no', 'purchased_at');
                            },
                        ])
                        ->select('id', 'order_id', 'product_id', 'store_id', 'attributes', 'delivered_at');
                },
            ])
            ->paginate(10)
            ->withQueryString();

        return inertia('User/MyReviews/Index', compact('productsToReview'));
    }

    public function addReview(Product $product): Response|ResponseFactory
    {
        $product->load(["orderItems:id,product_id,attributes"]);

        return inertia('User/MyReviews/AddReview', compact('product'));
    }

    public function store(ProductReviewRequest $request, Product $product): RedirectResponse
    {
        $productReview = (new CreateProductReviewAction())->handle($request->validated(), $product);

        return to_route("user.my-reviews.index", ["tab" => "to-review"])->with('success', 'Your rating has been successfully submitted.');
    }
}
