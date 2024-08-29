<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SignUpController extends Controller
{
    public function signup(Request $request){
        $validated = $request->validate([
            'name' => ['required', 'min:3','max:45'],
            'email' => ['required', 'max:50'],
            'cpf' => ['required', 'regex:([0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2})'],
            'birthDate' => ['required', 'after:01/01/1907', 'before:today'],
            'password' => ['required', 'min:8' ,'max:50']
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'cpf' => $validated['cpf'],
            'birthDate' => $validated['birthDate'],
            'password' => $validated['password'],
        ]);

        return redirect()->route('login');
    }
}