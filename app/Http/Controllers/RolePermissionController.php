<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('role-permissions.index', compact('roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('role-permissions.create', compact(
            'roles',
            'permissions'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $role = Role::findOrFail($request->role_id);
        $permission = Permission::findOrFail($request->permission_id);

        if ($role->hasPermissionTo($permission)) {
            return back()
                ->withErrors(['permission_id' => 'Deze koppeling bestaat al.'])
                ->withInput();
        }

        $role->givePermissionTo($permission);

        return redirect()->route('role-permissions.index');
    }

    public function edit($role_id, $permission_id)
    {
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);

        $roles = Role::all();
        $permissions = Permission::all();

        if (! $role->hasPermissionTo($permission)) {
            abort(404);
        }

        return view('role-permissions.edit', compact(
            'role',
            'permission',
            'roles',
            'permissions'
        ));
    }

    public function update(Request $request, $role_id, $permission_id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
            'permission_id' => 'required|exists:permissions,id',
        ]);

        $oldRole = Role::findOrFail($role_id);
        $oldPermission = Permission::findOrFail($permission_id);

        if (! $oldRole->hasPermissionTo($oldPermission)) {
            abort(404);
        }

        $newRole = Role::findOrFail($request->role_id);
        $newPermission = Permission::findOrFail($request->permission_id);

        if (
            ! ($oldRole->id == $newRole->id
                && $oldPermission->id == $newPermission->id)
            && $newRole->hasPermissionTo($newPermission)
        ) {
            return back()
                ->withErrors(['permission_id' => 'Deze koppeling bestaat al.'])
                ->withInput();
        }

        $oldRole->revokePermissionTo($oldPermission);
        $newRole->givePermissionTo($newPermission);

        return redirect()->route('role-permissions.index');
    }

    public function destroy($role_id, $permission_id)
    {
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);

        if (! $role->hasPermissionTo($permission)) {
            abort(404);
        }

        $role->revokePermissionTo($permission);

        return redirect()->route('role-permissions.index');
    }
}
