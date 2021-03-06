<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Home extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($user = Auth::user()) {
            if ($user->type == User::TOURIST)
                return redirect(localized_route('tourist.home'));
            elseif ($user->type == User::PRO)
                return redirect(localized_route('pro.home'));
        }

        return $next($request);
    }
}
