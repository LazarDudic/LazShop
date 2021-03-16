<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsBuyer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! optional($request->user())->hasRole('buyer')) {
            return back()->withErrors('Only customers can proceed to "'.trim($request->getRequestUri(), '/').'" page.');
        }

        return $next($request);
    }
}
