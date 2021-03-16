@extends('layouts.auth', ['title' => 'Edit User'])

@section('content')
    <div class="container p-4">
        <h1>Edit User</h1>
        <hr>
        @include('partials.messages')
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="">First Name</label>
                <input type="text" name="first_name" class="form-control"
                       value="{{ $user->first_name }}">
            </div>
            <div class="form-group">
                <label for="">Last Name</label>
                <input type="text" name="last_name" class="form-control"
                       value="{{ old('last_name') ?? $user->last_name }}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') ?? $user->email }}">
            </div>
            <div class="form-group text-danger">
                <label for="" >Role</label>
                <select name="role_id" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ $role->id == $user->role_id ? 'selected' : ''}}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
            <label for="">Country</label>
            <input type="text" name="country" class="form-control" placeholder="Country"
                   value="{{ old('country') ?? $user->address->country }}">
            </div>
            <div class="form-group">
                <label for="">State</label>
                <input type="text" name="state" class="form-control" placeholder="State"
                       value="{{ old('state') ?? $user->address->state }}">
            </div>
            <div class="form-group">
                <label for="">City</label>
                <input type="text" name="city" class="form-control" placeholder="City"
                       value="{{ old('city') ?? $user->address->city  }}">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Address"
                       value="{{ old('address') ?? $user->address->address  }}">
            </div>
            <div class="form-group">
                <label for="">Zipcode</label>
                <input type="text" name="zipcode" class="form-control" placeholder="Zipcode"
                       value="{{ old('zipcode') ?? $user->address->zipcode }}">
            </div>

    <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection




