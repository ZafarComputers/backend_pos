<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        // $users = User::with('role')->get();
        // return view('users.index', compact('users'));

        $users = User::with('role')->get();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }

    public function create() {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6',
            'role_id'=>'required|exists:roles,id'
        ]);

        // $data = $request->all();
        // $data['password'] = Hash::make($request->password);

        // User::create($data);
        
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        // return redirect()->route('users.index')->with('success','User created successfully');
        return response()->json(['success'=>'User created successfully!', 'user'=>$user->load('role')]);
    }

    public function edit(User $user) {
        $roles = Role::all();
        
        // return response()->json([
        //     'user' => $user,
        //     'roles' => $roles
        // ]);
        return view('users.edit', compact('user','roles'));

    }

    public function update(Request $request, User $user) {
    //     $request->validate([
    //         'first_name'=>'required',
    //         'last_name'=>'required',
    //         'email'=>'required|email|unique:users,email,'.$user->id,
    //         'role_id'=>'required|exists:roles,id'
    //     ]);

    //     $data = $request->all();
    //     if($request->password){
    //         $data['password'] = Hash::make($request->password);
    //     } else {
    //         unset($data['password']);
    //     }

    //     $user->update($data);

    //     return redirect()->route('users.index')->with('success','User updated successfully');
    // }

    // public function destroy(User $user) {
    //     $user->delete();
    //     return redirect()->route('users.index')->with('success','User deleted successfully');
    // }


        $validator = Validator::make($request->all(), [
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'role_id'=>'required|exists:roles,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $data = $request->all();
        if($request->password){
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json(['success'=>'User updated successfully!', 'user'=>$user->load('role')]);

    }

}


