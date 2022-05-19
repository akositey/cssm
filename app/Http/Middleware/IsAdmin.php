<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user() && Auth::user()->is_admin) {
            if (!$request->secure() && !in_array(env('APP_ENV'), ['local', 'dev'])) {
                return redirect()->secure($request->getRequestUri());
            }
            return $next($request);
        }
        return redirect(route('home'))->with("error", "Log in as admin to view that page.");
    }
}
