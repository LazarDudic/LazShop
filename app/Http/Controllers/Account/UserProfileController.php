<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfilePasswordRequest;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('account.profile.index', compact('user'));
    }

    public function edit(User $user)
    {
        abort_if($user->isNotAuthenticated(), 403);

        return view('account.profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        abort_if($user->isNotAuthenticated(), 403);

        $user->update($request->validated());

        return redirect(route('profile.index'))->withSuccess('Profile updated successfully');
    }

    public function updatePassword(UpdateProfilePasswordRequest $request, User $user)
    {
        abort_if($user->isNotAuthenticated(), 403);

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect(route('profile.index'))->withSuccess('Password updated successfully');

    }

}
