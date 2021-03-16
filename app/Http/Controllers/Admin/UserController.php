<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();

        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->only('first_name', 'last_name', 'email', 'role_id'));
        $user->address->update($request->only('country', 'state', 'city', 'address', 'zipcode'));

        return back()->withSuccess('User info updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->hasOngoingOrder()) {
            return back()->withErrors('User has order in process.');
        }

        $user->delete();

        return redirect(route('admin.user.index'))->withSuccess('User deleted successfully');
    }
}
