<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateRole
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
        $adminUri = [
            "/add-product",
            "/categories",
            "/update-product/([0-9]+)"
        ];

        $memberUri = [
            "/cart"
        ];

        $user = Auth::user();

        dd(array_search($request->getRequestUri(), $adminUri));
        if(array_search($request->getRequestUri(), $adminUri) >= 0) {
            // Can only be accessed by admin
            if($user->role == 'admin') {
                return $next($request);
            }
        }
        // >= 0 && array_search($request->getRequestUri(), $adminUri) < count($adminUri)
        else if(array_search($request->getRequestUri(), $memberUri) >= 0) {
            // Can only be accessed by registed member
            if($user->role == 'member') {
                return $next($request);
            }
        }
        else {
            // Can be accessed by everyone
            return $next($request);
        }

        // Not authenticated redirect somewhere else
        return redirect('/');
    }
}
