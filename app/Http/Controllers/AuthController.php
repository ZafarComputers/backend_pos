<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'cell_no1'              => 'nullable|string|max:20',
            'cell_no2'              => 'nullable|string|max:20',
            'img_path'              => 'nullable|string|max:255',
            'role_id'               => 'required|exists:roles,id',
            'password'              => 'required|string|min:6|confirmed',
            'status'                => 'in:active,inactive'
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name'  => $validated['last_name'],
            'email'      => $validated['email'],
            'cell_no1'   => $validated['cell_no1'] ?? null,
            'cell_no2'   => $validated['cell_no2'] ?? null,
            'img_path'   => $validated['img_path'] ?? null,
            'role_id'    => $validated['role_id'],
            'password'   => Hash::make($validated['password']),
            'status'     => $validated['status'] ?? 'active',
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'  => 'success',
            'message' => 'User registered successfully',
            'user'    => $user,
            'token'   => $token,
        ], 201);
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials provided.'],
            ]);
        }

        $user = Auth::user();

        // Optional: block inactive users
        if ($user->status === 'inactive') {
            return response()->json([
                'status'  => 'error',
                'message' => 'Account is inactive. Contact admin.'
            ], 403);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status'  => 'success',
            'message' => 'Login successful',
            'user'    => $user,
            'token'   => $token,
        ]);
    }

    /**
     * Logout user (Revoke current token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Logged out successfully'
        ]);
    }

    /**
     * Get authenticated user profile
     */
    public function profile(Request $request)
    {
        // dd($request);
        // $users = User::all();
        // dd($users);
        // dd('you are here... Profile', $request->user());
        return response()->json([
            'status' => 'success',
            'user'   => $request->user()
        ]);
    }
}
