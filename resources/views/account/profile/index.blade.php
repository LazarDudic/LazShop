@extends('layouts.auth', ['title' => 'Profile'])

@section('content')
    <div class="container p-4">
        <h1>User Personal Information</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary btn-sm float-right">Edit</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>First Name</th>
                            <td>{{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td>{{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
