@extends('layouts.app')
@section('title','Thank You!')
@section('content')
<div class="row">
    @if (session('message'))
    <div class=" text-center text-primary">
        <h3 class="text-center text-success">{{session('message')}}</h3>
        </div>

    @endif
    <div class="container text-center">
        <h1 class="mt-5">Thank you for your order!</h1>
        {{-- <p>Your order number is #123456</p> --}}
        {{-- <p>Total amount charged: ${{$this->totalproductAmount}}</p> --}}
        <p>You will receive an email with order details and tracking information shortly.</p>
        <h2>Enjoy your purchase!</h2>
        <p>Follow us on social media for exclusive offers and updates:</p>
        <p>
          <a href="#"><i class="fa fa-facebook-square fa-2x mr-3"></i></a>
          <a href="#"><i class="fa fa-twitter-square fa-2x mr-3"></i></a>
          <a href="#"><i class="fa fa-instagram fa-2x"></i></a>
        </p>
        <hr>
        <div class=" text-center">
            <div class=" text-center">
                <h4 class="text-primary text-center shadow-sm p-2">Enjoy To purchases New Product <a class="text-success" href="{{url('/collection')}}">Shop Now!</a></h4>
            </div>
        </div>
    </div>
</div>

@endsection
