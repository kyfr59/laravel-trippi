<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthIsTourist extends Middleware
{
    /**
     * Ensure that the user is connected as a tourist,
     * overwhise redirects to home
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guest() || Auth::user()->type != User::TOURIST) {
           return redirect(localized_route('/'));
        }

        return $next($request);
    }
}
