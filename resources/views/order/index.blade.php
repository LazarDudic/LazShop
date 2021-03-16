@extends('layouts.auth', ['title' => 'Orders'])

@section('content')
    <div class="container p-4">
        <h1>Orders</h1>
        <hr>
        @include('partials.messages')

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Transaction</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#ID</th>
                        <th>Transaction</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Customer</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <th>{{ $order->id }}</th>
                            <td class="small">{{ $order->transaction_id }}</td>
                            <td><div class="badge badge-info">{{ $order->status }} </div></td>
                            <td class="text-success">${{ $order->total }}</td>
                            <td>{{ $order->user->fullName() }}</td>

                            <td class="d-flex">
                                @can('order_access')
                                    <a href="{{ route('orders.show', $order->id) }}"
                                       class="btn btn-secondary btn-sm mr-2" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endcan
                                @can('order_edit')
                                    <a href="{{ route('orders.edit', $order->id) }}"
                                       class="btn btn-info btn-sm mr-2"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <h2 class="text-center">No order found.</h2>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
