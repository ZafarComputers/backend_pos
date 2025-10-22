<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name'  => 'required|string|max:255',
        'email'      => 'required|string|email|max:255|unique:users',
        'password'   => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'first_name' => $request->first_name,
        'last_name'  => $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'status' => 1,
        'role_id' => 2, // 👈 default role for normal users
    ]);

    auth()->login($user);

    return redirect('/dashboard')->with('success', 'Registration successful!');
}

}
