<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SearchUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        $roles = Role::all();

        return view('admin.user.index', compact('users', 'roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
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

    public function search(SearchUserRequest $request)
    {
        $roles = Role::all();

        $users = User::with('role')
                ->whereRaw('concat(first_name, " ", last_name) like ?', ['%' . $request->search . '%'])
                ->when($request->sort_role, function($query) use($request) {
                    $query->where('role_id', $request->sort_role);
                })
                ->orderByDesc('created_at')
                ->paginate(20)
                ->withQueryString();

        return view('admin.user.index', compact('users', 'roles'));
    }

}
