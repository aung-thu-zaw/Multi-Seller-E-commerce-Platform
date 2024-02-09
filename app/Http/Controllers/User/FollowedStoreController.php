<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Inertia\Response;
use Inertia\ResponseFactory;

class FollowedStoreController extends Controller
{
    public function __invoke(): Response|ResponseFactory
    {
        $followedStores = auth()->user()->followings()->with(['followable' => function ($query) {
            $query->withAvg(['storeReviews' => function ($query) {
                $query->where('status', 'approved');
            }], 'rating');
        }])->get();

        return inertia('User/FollowedStores', compact('followedStores'));
    }
}
