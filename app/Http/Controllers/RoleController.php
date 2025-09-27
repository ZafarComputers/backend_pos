<?php

// app/Http/Controllers/RoleController.php
namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        // $request->validate(['name' => 'required|unique:roles']);
        // Role::create($request->all());
        // return redirect()->route('roles.index')->with('success', 'Role created successfully');

        // return JSON for AJAX requests:
        $request->validate(['name' => 'required|unique:roles']);
        $role = Role::create($request->only('name'));

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully',
            'role' => $role
        ]);
        

    }

    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);
        $role->update($request->all());
        
        // return JSON for AJAX requests:
             // return response()->json([
            //     'success' => true,
            //     'message' => 'Role updated successfully',
            //     'role' => $role
            // ]);
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        
    }

    public function destroy(Role $role)
    {
        
        $role->delete();
        
        // return JSON for AJAX requests:
            // return response()->json([
            //         'success' => true,
            //         'message' => 'Role deleted successfully'
            //     ]);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully');

        }

    }
