<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Models\UserAddress;

class UserAddressController extends Controller
{
    public function index()
    {
        $userAddress = auth()->user()->address;

        return view('account.address.index', compact('userAddress'));
    }

    public function edit(UserAddress $userAddress)
    {
        abort_if($userAddress->isNotFromAuthenticatedUser(), 403);

        return view('account.address.edit', compact('userAddress'));
    }

    public function update(UpdateAddressRequest $request, UserAddress $userAddress)
    {
        abort_if($userAddress->isNotFromAuthenticatedUser(), 403);

        $userAddress->update($request->validated());

        return redirect(route('address.index'))->withSuccess('Address updated successfully');
    }

}
