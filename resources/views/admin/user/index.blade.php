@extends('layouts.auth', ['title' => 'Users'])

@section('content')
    <div class="container p-4">
        <h1>Users</h1>
        <hr>
        @include('partials.messages')
        <div class="card mb-4">
            <div class="card-header d-lg-flex justify-content-between">
                <form action="{{ route('users.search') }}" method="GET" class="form-inline">
                    <input name="search" type="text" placeholder="search..." class="form-control mr-lg-1"
                           value="{{ request()->search }}">
                    Sort by:
                    <select name="sort_role" class="form-control ml-lg-1">
                        <option value="">
                            All
                        </option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request()->sort_role == $role->id ? 'selected' : '' }}>
                            {{ ucwords($role->name) }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-info btn ml-1">Search</button>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Role</th>
                            <th>Signed Up</th>
                            <th class="w-lg-25">Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Signed Up</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->fullName() }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>{{ $user->created_at->format('Y.m.d H:i') }}</td>
                                @if($user->first_name != 'admin')
                                    <td class="d-flex">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="btn btn-info btn-sm mr-2" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                              onsubmit="return confirm('Are you sure?')">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $users->links() }}
            </div>
        </div>
    </div>

@endsection
