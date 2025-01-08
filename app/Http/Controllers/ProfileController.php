<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request):RedirectResponse{
        $user = Auth::user();
        $validated_data = $request->validate([
          "name"=>"required|string",
          "email"=>"required|string|email",
          "avatar"=>"nullable|image|mimes:jpg,jpeg,gif,png|max:2048"
        ]);
        if($request->hasFile("avatar")){
            if($user->avatar){
                unlink("storage/avatars/".basename($user->avatar));
            }
            $path = $request->file("avatar")->store("avatars","public");
            $validated_data["avatar"]=$path;
        }
        $user->update($validated_data);
        return redirect()->route("dashboard")->with("success","user updated successfuly!");
    }
}
