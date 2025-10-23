<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Resources
use App\Http\Resources\PermissionResource;

// Models
use App\Models\Permission;
use App\Models\Role;

class PermissionApiController extends Controller
{
    /**
     * Display all permissions with their related roles.
     */
    public function index()
    {
        $permissions = Permission::with('roles')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Permission list retrieved successfully.',
            'data' => PermissionResource::collection($permissions),
        ]);
    }

    /**
     * Store a newly created permission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:permissions,name',
            'slug'        => 'nullable|string|max:100|unique:permissions,slug',
            'description' => 'nullable|string|max:255',
            'status'      => 'nullable|in:active,inactive',
            'role_ids'    => 'nullable|array',
            'role_ids.*'  => 'exists:roles,id',
        ]);

        DB::beginTransaction();
        try {
            $permission = Permission::create([
                'name'        => $validated['name'],
                'slug'        => $validated['slug'] ?? str()->slug($validated['name']),
                'description' => $validated['description'] ?? null,
                'status'      => $validated['status'] ?? 'active',
            ]);

            // attach roles if provided
            if (!empty($validated['role_ids'])) {
                $permission->roles()->attach($validated['role_ids']);
            }

            DB::commit();

            $permission->load('roles');

            return response()->json([
                'success' => true,
                'message' => 'Permission created successfully.',
                'data'    => new PermissionResource($permission),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create permission.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show a single permission.
     */
    public function show(Permission $permission)
    {
        $permission->load('roles');

        return response()->json([
            'success' => true,
            'message' => 'Permission retrieved successfully.',
            'data' => new PermissionResource($permission),
        ]);
    }

    /**
     * Update an existing permission.
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:100|unique:permissions,name,' . $permission->id,
            'slug'        => 'nullable|string|max:100|unique:permissions,slug,' . $permission->id,
            'description' => 'nullable|string|max:255',
            'status'      => 'nullable|in:active,inactive',
            'role_ids'    => 'nullable|array',
            'role_ids.*'  => 'exists:roles,id',
        ]);

        DB::beginTransaction();
        try {
            $permission->update([
                'name'        => $validated['name'] ?? $permission->name,
                'slug'        => $validated['slug'] ?? $permission->slug,
                'description' => $validated['description'] ?? $permission->description,
                'status'      => $validated['status'] ?? $permission->status,
            ]);

            if (isset($validated['role_ids'])) {
                $permission->roles()->sync($validated['role_ids']);
            }

            DB::commit();

            $permission->load('roles');

            return response()->json([
                'success' => true,
                'message' => 'Permission updated successfully.',
                'data' => new PermissionResource($permission),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update permission.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove a permission.
     */
    public function destroy(Permission $permission)
    {
        try {
            $permission->roles()->detach();
            $permission->delete();

            return response()->json([
                'success' => true,
                'message' => 'Permission deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete permission.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
