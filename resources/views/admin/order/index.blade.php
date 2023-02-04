@extends('layouts.admin')
@section('title', 'Order')
@section('content')


    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Order List
                        <a href="{{ url('admin/order') }}" class="btn btn-primary float-end btn-sm">BACK
                        </a>
                    </h3>

                </div>

                <div class="card-body">
                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="">Filter By Date</label>
                                <input type="date" name="date" id=""
                                    value="{{ Request::get('date') ?? date('y-m-d') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label for="">Filter By Status</label>
                                <select name="status" class="form-control">
                                    <option value="">Select All Status</option>
                                    <option
                                        value="in progress"{{ Request::get('status') == 'in progress' ? 'selected' : '' }}>
                                        In
                                        Progress</option>
                                    <option value="completed"{{ Request::get('status') == 'completed' ? 'selected' : '' }}>
                                        Completed
                                    </option>
                                    <option value="pending"{{ Request::get('status') == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="cancelled"{{ Request::get('status') == 'cancelled' ? 'selected' : '' }}>
                                        Cancelled
                                    </option>
                                    <option
                                        value="out_for_delivery"{{ Request::get('status') == 'out_for_delivery' ? 'selected' : '' }}>
                                        Out For Delivery
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <br>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="row mt-1">
                    <div class="col-md-10 mx-auto">
                        <table class="table table-bordered table-striped table-responsive-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>User Name</th>
                                    <th>Payment Mode</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->fullname }}</td>
                                        <td>{{ $order->payment_mode }}</td>
                                        <td>{{ $order->created_at->format('d-m-y') }}</td>
                                        <td>{{ $order->status_message }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/order/' . $order->id) }}"
                                                class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Order Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>


        @endsection
