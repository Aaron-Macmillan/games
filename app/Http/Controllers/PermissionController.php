<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
   {
    $permissions = Permission::all();

    return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('permissions.create');
     }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255|unique:permissions,name',
    ]);

    Permission::create([
        'name' => $request->name,
        'guard_name' => 'web',
    ]);

    return redirect()->route('permissions.index');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
     {
     return view('permissions.edit', compact('permission'));
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
{
    $request->validate([
        'name' => 'required',
    ]);

    $permission->update([
        'name' => $request->name,
    ]);

    return redirect('/permissions');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
{
    $permission->delete();

    return redirect('/permissions');
}
}
