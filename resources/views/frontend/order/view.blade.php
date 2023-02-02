@extends('layouts.app')
@section('title', 'My Order Deails')
@section('content')
    <div class="row">
        <div class="py-3">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                            <a href="{{ url('/order') }}" class="btn btn-primary float-end btn-sm text-white">Back</a>
                        </h3>

                    </div>
                </div>
                <div class="py-md-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shadow bg-white p-3">
                                    <h4 class="text-primary"></h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5>Order Details</h5>
                                            <hr>
                                            <h6>Order Id : {{ $orders->id }}</h6>
                                            <h6>Order Created Date : {{ $orders->created_at->format('d-m-y') }}</h6>
                                            <h6>Payment Mode : {{ $orders->payment_mode }}</h6>
                                            <h6 class="border-p-2 text-success">Order Status Message : <span
                                                    class="text-uppercase">{{ $orders->status_message }}</span></h6>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>User Details</h5>
                                            <hr>
                                            <h6>User Full Name : {{ $orders->fullname }}</h6>
                                            <h6>User Email ID : {{ $orders->email }}</h6>
                                            <h6>User Phone : {{ $orders->phone }}</h6>
                                            <h6>User Address : {{ $orders->address }}</h6>
                                            <h6>User PinCode : {{ $orders->pincode }}</h6>
                                        </div>
                                    </div>
                                    <br>
                                    <hr>
                                    <h5>Order Items</h5>
                                    <div class="row mt-1">
                                        <div class="col-md-10 mx-auto">
                                            <table class="table table-bordered table-striped table-responsive-sm">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Item ID</th>
                                                        <th> Image</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $totalPrice=0;
                                                    @endphp
                                                    {{-- order many relation to orderItem --}}
                                                    @forelse ($orders->OrderItem as $orderItem)
                                                        <tr>
                                                            <td>{{ $orderItem->id }}</td>



                                                            <td>
                                                                @if ($orderItem->product->ProductImage)
                                                                <img src="{{ url($orderItem->product->ProductImage[0]->image) }}"
                                                                    style="width: 50px; height: 50px"
                                                                    alt=" {{ $orderItem->product->name }}">
                                                            @else
                                                                <img src="" style="width: 50px; height: 50px"
                                                                    alt=" {{ $orderItem->product->name }}">
                                                            @endif
                                                            </td>
                                                            <td>
                                                                {{ $orderItem->product->name }}
                                                                @if ($orderItem->ProductColor)
                                                                    <span>-Color:{{ $orderItem->ProductColor->color->name }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ $orderItem->price }}</td>
                                                            <td>{{ $orderItem->quantity }}</td>
                                                            <td class="fw-bold"> ${{$orderItem->price* $orderItem->quantity}}
                                                            </td>
                                                            @php
                                                                $totalPrice +=$orderItem->price* $orderItem->quantity;
                                                            @endphp
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">No Order Found</td>
                                                        </tr>
                                                    @endforelse
                                                    <tr>
                                                        <td colspan="5" class="fw-bold">Total Amount</td>
                                                        <td colspan="1" class="fw-bold">${{$totalPrice}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
