<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;   // ✅ correct Auth facade
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;


class AuthApiController extends Controller
{
    use ApiResponse;
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => new UserResource($user)
        ]);

        // return response()->json([
        //     'token' => $token,
        //     'user'  => UserResource::collection(collect([$user]))
        // ]);

    }
    // public function login(Request $request)
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required']
    //     ]);

    //     if (!Auth::attempt($credentials)) {
    //         return response()->json(['message' => 'Invalid credentials'], 401);
    //     }

    //     $user = Auth::user();
    //     $token = $user->createToken('api-token')->plainTextToken;

    //     return response()->json([
    //         'token' => $token,
    //         'user'  => $user
    //     ]);
    // }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

    public function profile(Request $request)
    {
        $user = $request->user();
        $user->load(['role', 'profile']); // Load relationships
        
        return response()->json([
            'user' => new UserResource($user)
        ]);
    }

    public function refreshToken(Request $request)
    {
        $user = $request->user();
        
        // Delete current token
        $request->user()->currentAccessToken()->delete();
        
        // Create new token
        $token = $user->createToken('api-token')->plainTextToken;
        
        return response()->json([
            'token' => $token,
            'user' => new UserResource($user)
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();
        
        $data = $request->validate([
            'first_name' => 'sometimes|string|max:100',
            'last_name'  => 'sometimes|string|max:100',
            'cell_no1'   => 'sometimes|nullable|string',
            'cell_no2'   => 'sometimes|nullable|string',
        ]);
        
        $user->update($data);
        
        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => new UserResource($user)
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = $request->user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->error('Current password is incorrect', 400);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return $this->success(null, 'Password changed successfully');
    }

    public function getUsersByRole(Request $request, $roleName)
    {
        $users = User::whereHas('role', function($query) use ($roleName) {
            $query->where('name', $roleName);
        })->with(['role', 'profile'])->get();

        return $this->success(UserResource::collection($users), 'Users retrieved successfully');
    }

}
