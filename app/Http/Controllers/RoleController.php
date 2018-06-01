<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admins.role.create', compact(['roles','permissions']));
    }

    public function store(Request $request)
    {
        $roles = Role::all();
        $this->validate($request, [
            'name' => 'string|max:30',
        ]);
        foreach ($roles as $role) {
            if ($role->name == $request->name) {
                return Redirect::back()->withErrors(['This name has been taken']);
            }
        }
        $r = Role::create(['name'=>$request->name]);

        return redirect()->route('admin.role')->with('messenger', 'Create Role Successed!!!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admins.role.edit', compact(['role','permissions']));
    }

    public function update(Request $request)
    {
        $role = Role::findOrFail($request->roleID);
        $role->syncPermissions($request->permission);
        return redirect()->route('admin.role')->with('messenger', 'Update Role Successed!!!');
    }
}
