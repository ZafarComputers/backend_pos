<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Resources
use App\Http\Resources\UserResource;

// Models
use App\Models\User;

class UserApiController extends Controller
{
    public function index()
    {
        return UserResource::collection(
            User::with(['profile', 'roles'])->paginate(10)
        );
    }

    public function show($id)
    {
        return new UserResource(
            User::with(['profile', 'roles'])->findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // 'first_name' => 'required|string|max:100',
            // 'last_name'  => 'required|string|max:100',
            // 'email'      => 'required|email|unique:users,email',
            // 'role_id'   => 'required|exists:roles,id',
            // 'password'   => 'required|string|min:8',
            // 'role_id'    => 'required|exists:roles,id',

            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'email'              => 'required|email|unique:users,email',
            'cell_no1'           => 'required|string|max:20',
            'cell_no2'           => 'nullable|string|max:20',
            'role_id'            => 'required|exists:roles,id', // adjust if roles table exists
            'img_path'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email_verified_at'  => 'nullable|date',
            'password'           => 'required|string|min:8|confirmed', // needs password_confirmation
            'status'             => 'required|in:active,inactive',
            
        ]);

        $user = User::create([
            ...$data,
            'password' => bcrypt($data['password']),
        ]);

        return new UserResource($user->load(['profile', 'roles']));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'first_name' => 'sometimes|string|max:100',
            'last_name'  => 'sometimes|string|max:100',
            'email'      => 'sometimes|email|unique:users,email,' . $user->id,
            'role_id'   => 'required|exists:roles,id',
            'password'   => 'nullable|string|min:8',
            // 'role_id'    => 'sometimes|exists:roles,id',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        return new UserResource($user->load(['profile', 'roles']));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }

}
