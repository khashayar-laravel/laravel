<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    // @desc Show Register Form
    // @route GET/Register
    public function register():view{
        return view("auth.register");
    }
    public function store(Request $request):RedirectResponse{
        $validated_data = $request->validate([
           "name"=>"string|required",
           "email"=>"string|required|unique:users",
           "password"=>"string|required|min:3|confirmed",
        ]);

        $validated_data["password"] = Hash::make($validated_data["password"]);

        User::create($validated_data);

        return (redirect()->route("login")->with("success","you have been registered successfuly!"));

    }
}
