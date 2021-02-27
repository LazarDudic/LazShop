@extends('layouts.auth', ['title' => 'Roles'])


@section('content')
    <div class="container p-4">
        <h1>Create Role</h1>
        <hr>
        @include('partials.messages')

        @if(isset($role))
            <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
        @else
            <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
        @endif
            @csrf

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Role Name"
                       value="{{ old('name') ?? $role->name ?? ''}}">
            </div>

            <div class="row form-group ml-4" >
            @foreach($permissions as $permission)
                <div class="col-md-4" style="border-bottom: 1px solid cornflowerblue">
                    <input name="permissions[]" value="{{ $permission->id }}" type="checkbox" class="form-check-input" id="{{ $permission->name }}"
                        @if(isset($rolePermissions) && $rolePermissions->contains('name', $permission->name))
                            checked
                        @endif
                    >
                    <label class="form-check-label" for="{{ $permission->name }}"><strong>{{ $permission->name }}</strong></label>

                </div>
            @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection


