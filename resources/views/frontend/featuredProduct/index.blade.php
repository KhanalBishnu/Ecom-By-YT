@extends('layouts.app')
@section('title', 'New Featured Product')
@section('content')

    <div class="py-5">

        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <h4>New Featured Product</h4>
                    <div class="underline mb-4">

                    </div>
                </div>


                {{-- copy from product/index --}}
                @forelse ($featuredProduct as $productItem)
                    <div class="col-md-3 ">
                        <div class="product-card">

                            <div class="product-card-img">

                                <label class="stock bg-danger">New</label>


                                <a
                                    href="{{ url('/collection/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                    <img style=" width: 100%; height: 200px;"
                                        src="{{ asset($productItem->ProductImage[0]->image) }}"
                                        alt=" {{ $productItem->name }}">
                                </a>

                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $productItem->brand }}</p>
                                <h5 class="product-name">
                                    <a
                                        href="{{ url('/collection/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                        {{ $productItem->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price">{{ $productItem->selling_price }}</span>
                                    <span class="original-price">{{ $productItem->original_price }}</span>
                                </div>
                                {{-- <div class="mt-2">
                                <a href="" class="btn btn1">Add To Cart</a>
                                <a href="" class="btn btn1"> <i class="fa fa-heart"></i> </a>
                                <a href="" class="btn btn1"> View </a>
                            </div> --}}
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="col-md-12">
                        <div class="p-4">
                            <h1>No Featured Product Available </h1>
                        </div>
                    </div>
                @endforelse




            </div>

        </div>
    </div>
    </div>
    @section('script')
        <script>
            $('.trending-product').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })
        </script>
    @endsection


@endsection
