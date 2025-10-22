<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function index()
    {
        return ProfileResource::collection(Profile::with('user')->paginate(10));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'profile_picture' => 'nullable|string|max:255',
        ]);

        $profile = Profile::create($data);

        return new ProfileResource($profile->load('user'));
    }

    public function show(Profile $profile)
    {
        return new ProfileResource($profile->load('user'));
    }

    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'profile_picture' => 'nullable|string|max:255',
        ]);

        $profile->update($data);

        return new ProfileResource($profile->load('user'));
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();
        return response()->json(['message' => 'Profile deleted successfully']);
    }
}
