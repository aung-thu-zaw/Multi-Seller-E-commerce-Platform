<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class MyReviewController extends Controller
{
    public function index(): Response|ResponseFactory
    {
        // $productsToReview = Product::select("id", 'name', 'store_id', 'image')->with(["store:id,seller_id,store_name"])->whereHas('orderItems', function ($query) {
        //     $query->whereHas('order', function ($orderQuery) {
        //         $orderQuery->where('user_id', auth()->id())
        //                    ->where('status', 'delivered');
        //     });
        // })
        // ->whereDoesntHave('productReviews', function ($query) {
        //     $query->where('user_id', auth()->id());
        // })
        // ->paginate(10)->withQueryString();

        $productsToReview = Product::select("id", 'name', 'store_id', 'image')
        ->with("store:id,seller_id,store_name")
        ->whereHas('orderItems', function ($query) {
            $query->whereHas('order', function ($orderQuery) {
                $orderQuery->where('user_id', auth()->id())
                           ->where('status', 'delivered');
            });
        })
        ->whereDoesntHave('productReviews', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->with(['orderItems' => function ($query) {
            $query->with(['order' => function ($orderQuery) {
                $orderQuery->where('user_id', auth()->id())
                           ->where('status', 'delivered')
                           ->select('id', 'purchased_date');
            }, 'attributes']);
        }])
        ->paginate(10)
        ->withQueryString();

        return inertia('User/MyReviews/Index', compact("productsToReview"));
    }
}
