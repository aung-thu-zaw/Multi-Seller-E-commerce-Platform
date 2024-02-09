<?php

namespace App\Http\Middleware;

use App\Models\Category;
use App\Models\GeneralSetting;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $user = $request->user();

        return [
            'recaptcha_site_key' => config('services.google_recaptcha.site_key'),
            ...parent::share($request),
            'auth' => [
                'user' => $user,
                'permissions' => $user ? $user->permissions->pluck('name')->all() : [],
                'notifications' => $user ? $user->notifications : [],
                'store' => $user ? $user->store : [],
                'wishlists' => $user ? $user->wishlists : [],
                'cart' => $user ? $user->cart()->with(['cartItems.product.store:id,store_name,slug', 'cartItems.product.skus.attributeOptions.attribute'])->first() : [],
                'conversations' => $user ? $user->conversations()->with(['conversationMessages.customer:id,name,avatar', 'conversationMessages.store:id,store_name,avatar', 'customer:id,name,avatar', 'store:id,store_name,avatar'])->latest()->get() : [],
            ],
            'parentCategory' => Category::with('children')->whereNull('parent_id')->get(),
            'generalSetting' => GeneralSetting::first(),
            'searchHistories' => SearchHistory::orderBy('id', 'desc')->get(),
            'language' => session('language'),
            'flash' => [
                'success' => session('success'),
                'error' => session('error'),
            ],
            'ziggy' => fn () => [
                ...(new Ziggy())->toArray(),
                'location' => $request->url(),
                'query' => $request->query(),
            ],
        ];
    }
}
