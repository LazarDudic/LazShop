@extends('layouts.auth', ['title' => 'Edit Profile'])

@section('content')
    <div class="container p-4">
        <h1>Edit Profile</h1>
        <hr>
        @include('partials.messages')
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        <hr>
        <form action="{{ route('profile.update-password', $user->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="">Old Password</label>
                <input type="password" name="old_password" class="form-control" placeholder="Old password">
            </div>
            <div class="form-group">
                <label for="">New Password</label>
                <input type="password" name="new_password" class="form-control" placeholder="New password">
            </div>
            <div class="form-group">
                <label for="">Confirm</label>
                <input type="password" name="new_password_confirmation" class="form-control" placeholder="Confirm">
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

@endsection




