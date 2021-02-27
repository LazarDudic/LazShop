<?php

namespace App\Http\Controllers\Auth\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        $roles = Role::all();

        return view('auth.role.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('auth.role.create', compact('permissions'));
    }


    public function store(CreateRoleRequest $request)
    {
        $role = Role::create($request->only('name'));

        $role->permissions()->sync($request->permissions);
        return redirect(route('roles.index'))->withSuccess('Role created successfully.');
    }
    
    public function edit(Role $role)
    {
        abort_if($role->name == 'admin', 403);


        $rolePermissions = $role->permissions;
        $permissions = Permission::all();

        return view('auth.role.create', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        abort_if($role->name == 'admin', 403);

        $role->update($request->only('name'));
        $role->permissions()->sync($request->permissions);

        return redirect(route('roles.index'))->withSuccess('Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        abort_if($role->name == 'admin', 403);

        $role->delete();
        return redirect(route('roles.index'))->withSuccess('Role deleted successfully.');
    }
}
