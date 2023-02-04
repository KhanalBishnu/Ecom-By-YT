@extends('layouts.admin')
@section('title', 'Order')
@section('content')


    <div class="row">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success">{{session('message')}}</div>

            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Order List
                        <a href="{{ url('admin/order') }}" class="btn btn-primary float-end btn-sm">BACK
                            </a>
                    </h3>

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
                    @forelse ($orders as $order )
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->fullname}}</td>
                        <td>{{$order->payment_mode}}</td>
                        <td>{{$order->created_at->format('d-m-y')}}</td>
                        <td>{{$order->status_message}}</td>
                        <td class="text-center">
                            <a href="{{url('admin/order/'.$order->id)}}" class="btn btn-primary btn-sm">View</a>
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
                {{$orders->links()}}
            </div>
        </div>
    </div>
</div>


@endsection
