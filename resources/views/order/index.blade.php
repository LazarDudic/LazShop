@extends('layouts.auth', ['title' => 'Orders'])

@section('content')
    <div class="container p-4">
        <h1>Orders</h1>
        <hr>
        @include('partials.messages')

        <div class="card mb-4">
            <div class="card-header d-lg-flex justify-content-between">
                <form action="{{ route('orders.search') }}" method="GET" class="form-inline">
                    <input name="search" type="text" placeholder="search..." class="form-control mr-lg-1"
                           value="{{ request()->search }}">
                    Sort by:
                    <select name="sort_status" class="form-control ml-lg-1">
                        <option value="">
                            All
                        </option>
                        <option value="paid" {{ request()->sort_status === 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>
                        <option value="shipped" {{ request()->sort_status === 'shipped' ? 'selected' : '' }}>
                            Shipped
                        </option>
                        <option value="delivered" {{ request()->sort_status === 'delivered' ? 'selected' : '' }}>
                            Delivered
                        </option>
                        <option value="dispute" {{ request()->sort_status === 'dispute' ? 'selected' : '' }}>
                            Dispute
                        </option>
                        <option value="refunded" {{ request()->sort_status === 'refunded' ? 'selected' : '' }}>
                            Refunded
                        </option>
                    </select>
                    <button type="submit" class="btn btn-info btn ml-1">Search</button>
                </form>
            </div>
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
                            <th>Created At</th>
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
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <th>{{ $order->id }}</th>
                                <td class="small">{{ $order->transaction_id }}</td>
                                <td>
                                    <div class="badge badge-{{ orderStatusColor($order->status) }}">
                                        {{ $order->status }}
                                    </div>
                                </td>
                                <td class="text-success">${{ $order->total }}</td>
                                <td>{{ $order->user->fullName() }}</td>
                                <td>{{ $order->created_at->format('Y.m.d H:i') }}</td>

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
                {{ $orders->links() }}
            </div>
        </div>
    </div>

@endsection
