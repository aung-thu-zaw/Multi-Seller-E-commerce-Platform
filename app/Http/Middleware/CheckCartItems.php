<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCartItems
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->cart) {

            if ($request->user()->cart->cartItems->isNotEmpty()) {
                return $next($request);
            }
        }

        return redirect()->route('home')->with('error', 'You must have items in your cart to proceed to checkout.');
    }
}
