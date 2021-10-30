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
            "/categories"
        ];

        $memberUri = [
            "/cart"
        ];

        $user = Auth::user();

        if(array_search($request->getRequestUri(), $adminUri)) {
            // Can only be accessed by admin
            if($user->role == 'admin') {
                return $next($request);
            }
        }
        else if(array_search($request->getRequestUri(), $memberUri)) {
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
