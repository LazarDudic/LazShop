@extends('layouts.auth', ['title' => 'Address'])

@section('content')
    <div class="container p-4">
        <h1>User Address</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                <a class="btn btn-primary btn-sm float-right"
                   href="{{ isset($userAddress)
                                               ? route('address.edit', $userAddress->id)
                                               : route('address.create') }}"
                   >
                    {{ isset($userAddress) ? 'Edit' : 'Create'}}
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        @if(isset($userAddress))
                            <tr>
                                <th>Country</th>
                                <td>{{ $userAddress->country }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $userAddress->state }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $userAddress->city }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $userAddress->address }}</td>
                            </tr>
                            <tr>
                                <th>Zipcode</th>
                                <td>{{ $userAddress->zipcode }}</td>
                            </tr>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
