<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserCanCheckout
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->role !== 'user') {
            return redirect()->back();
        }
        return $next($request);
    }
}
