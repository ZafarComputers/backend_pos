<?php


namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;


use App\Models\Role;
use Illuminate\Http\Request;

class RoleApiController extends Controller
{
    public function index()
    {
        return response()->json(Role::with('permissions')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name',
            'slug' => 'required|string|unique:roles,slug',
        ]);

        $role = Role::create($data);
        return response()->json(['status' => true, 'role' => $role]);
    }

    public function show(Role $role)
    {
        return response()->json($role->load('permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id,
            'slug' => 'required|string|unique:roles,slug,' . $role->id,
        ]);

        $role->update($data);
        return response()->json(['status' => true, 'role' => $role]);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['status' => true, 'message' => 'Role deleted']);
    }

    public function assignPermission(Request $request, Role $role)
    {
        $request->validate(['permission_ids' => 'required|array']);
        $role->permissions()->sync($request->permission_ids);
        return response()->json(['status' => true, 'message' => 'Permissions assigned']);
    }
}
