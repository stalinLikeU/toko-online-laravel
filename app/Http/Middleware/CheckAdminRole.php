<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('admin/login')) {
            return $next($request);
        }
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('index');
        }
        return $next($request);
    }
}
