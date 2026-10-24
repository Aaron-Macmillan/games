<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();

        return view('user-roles.index', compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();

        return view('user-roles.create', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $role = Role::findOrFail($request->role_id);

        if ($user->hasRole($role->name, $role->guard_name)) {
            return back()
                ->withErrors(['role_id' => 'Deze gebruiker heeft deze rol al.'])
                ->withInput();
        }

        $user->assignRole($role);

        return redirect()->route('user-roles.index');
    }

    public function edit($user_id, $role_id)
    {
        $user = User::findOrFail($user_id);
        $role = Role::findOrFail($role_id);

        if (! $user->hasRole($role->name, $role->guard_name)) {
            abort(404);
        }

        $users = User::all();
        $roles = Role::all();

        return view('user-roles.edit', compact(
            'user',
            'role',
            'users',
            'roles'
        ));
    }

    public function update(Request $request, $user_id, $role_id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $oldUser = User::findOrFail($user_id);
        $oldRole = Role::findOrFail($role_id);

        if (! $oldUser->hasRole($oldRole->name, $oldRole->guard_name)) {
            abort(404);
        }

        $newUser = User::findOrFail($request->user_id);
        $newRole = Role::findOrFail($request->role_id);

        if (
            ! ($oldUser->id == $newUser->id && $oldRole->id == $newRole->id)
            && $newUser->hasRole($newRole->name, $newRole->guard_name)
        ) {
            return back()
                ->withErrors(['role_id' => 'Deze gebruiker heeft deze rol al.'])
                ->withInput();
        }

        $oldUser->removeRole($oldRole);
        $newUser->assignRole($newRole);

        return redirect()->route('user-roles.index');
    }

    public function destroy($user_id, $role_id)
    {
        $user = User::findOrFail($user_id);
        $role = Role::findOrFail($role_id);

        if (! $user->hasRole($role->name, $role->guard_name)) {
            abort(404);
        }

        $user->removeRole($role);

        return redirect()->route('user-roles.index');
    }
}
