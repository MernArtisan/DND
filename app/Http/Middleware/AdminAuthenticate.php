<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        if (Auth::user()->role === 'user' && Auth::user()->role === 'streamer') {
            return redirect()->route('home.index')->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
