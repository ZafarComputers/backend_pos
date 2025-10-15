<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

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
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:8',
            // 'role_id'    => 'required|exists:roles,id',
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
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
