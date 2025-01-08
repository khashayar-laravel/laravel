<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use MongoDB\Driver\Session;

class LoginController extends Controller
{
    // @desc Show Login Form
    // @route GET/Login
    public function login():view{
        return view("auth.login");
    }
    public function authenticate(Request $request){
        $credential = $request->validate([
            "email"=>"string|required",
            "password"=>"string|required|min:3",
        ]);
        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->intended(route("home"))->with('success','You are now logged in!');
        }
        return back()->withErrors([
            'email'=> "The provided credentials do not math our records",
        ])->onlyInput('email');
    }

    public function logout(Request $request):RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return(redirect()->route("home"));
    }

}
