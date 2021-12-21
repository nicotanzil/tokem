<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('profile.index');
    }

    public function detail(){
        return view('profile.update');
    }

    public function update(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'password' => 'required|confirmed|min:8',
            'address' => 'required|min:15',
            'phone' => 'required|digits_between:11,255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->phone = $request->phone;

        $user->save();

        return redirect('/profile')->with('successful_message', 'Success Update Profile');
    }
}
