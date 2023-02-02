@extends('layouts.app')
@section('title', 'Order')
@section('content')

<div class="row">
    <div class="col-md-8 mx-auto my-2">
        <h4 class="text-center text-black font-weight-bold mb-4">Order Details</h4>
        <hr class="mb-1">
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
                            <a href="{{url('/order/'.$order->id)}}" class="btn btn-primary btn-sm">View</a>
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
