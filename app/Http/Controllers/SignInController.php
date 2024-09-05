<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function signin(Request $request){
        if(Auth::attempt([
            'email' => $request ->email,
            'password' => $request->password,
        ])){
            $request->session()->regenerate(true);
            return redirect()->route('home');
        } 
        return redirect()->route('login');
    }
}
