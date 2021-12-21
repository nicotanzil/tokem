<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application home.
     * 
     */
     public function index(Request $request) {
        $user = Auth::user();
        
        return view('home')->with('user', $user);
     }
}
