<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $email = $request->cookie('stored_email');
        return view('auth.login', [
            'email' => $email
        ]);
        
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        $remember_email = $request->has('remember_email') ? true : false;

        if($remember_email){
            $minutes = 60*24*365*5;
            Cookie::queue("stored_email", $request->email, $minutes);
        }


        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();
            return redirect('/');
        }else{
            // session()->put('error-message', 'Please enter valid username and password');
            return redirect('/login')->with('error-message', 'Please enter valid username and password');
        }

        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
