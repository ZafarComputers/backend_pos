<?php

namespace App\Http\Controllers\Api;
// Controllers
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Resources
use App\Http\Resources\RoleResource;

// Models
use App\Models\Role;
use App\Models\Permission;

class RoleApiController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return RoleResource::collection($roles);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Role list retrieved successfully.',
        //     'data' => $roles
        // ]);
    }

    public function show(Role $role)
    {
        $role->load('permissions');
        return new RoleResource($role);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Role details retrieved successfully.',
        //     'data' => $role
        // ]);

    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'required|string|unique:roles,slug',
            'description' => 'nullable|string',
        ]);

        $role = Role::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Role created successfully.',
            'data' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'slug' => 'sometimes|string|unique:roles,slug,' . $role->id,
            'description' => 'nullable|string',
        ]);

        $role->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Role updated successfully.',
            'data' => $role
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'success' => true,
            'message' => 'Role deleted successfully.'
        ]);
    }

    public function assignPermissions(Request $request, Role $role)
    {
        $validated = $request->validate([
            'permission_ids' => 'required|array',
            'permission_ids.*' => 'exists:permissions,id',
        ]);

        $role->permissions()->sync($validated['permission_ids']);

        return response()->json([
            'success' => true,
            'message' => 'Permissions assigned successfully.',
            'data' => $role->load('permissions')
        ]);
    }
}
