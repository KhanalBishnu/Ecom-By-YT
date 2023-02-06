@extends('layouts.app')
@section('title', 'Home Page')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide">

        <div class="carousel-inner">
            @foreach ($sliders as $key => $sliderItem)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    @if ($sliderItem->image)
                        <img src="{{ asset("$sliderItem->image") }}" class="d-block w-100" alt="..."
                            style="width:90px;height:500px">
                    @endif
                    {{-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $sliderItem->title }}</h5>
                        <p>{{ $sliderItem->description }}</p>
                    </div> --}}
                    <div class="carousel-caption d-none d-md-block">
                        <h1>
                            {{ $sliderItem->title }}
                        </h1>
                        <p>
                            {{ $sliderItem->description }}
                        </p>
                        <div>
                            <a href="#" class="btn btn-slider">
                                Get Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        <div class="container">
            <div class="py-5 text-center">
                <h4 class="text-center">Hatela Ecom</h4>
                <hr class="mx-auto w-25 underline">
                <p class="text-center">Hatela Ecom is an e-commerce website that provides a platform for individuals and
                    businesses to buy and sell products and services online. This website allows its users to browse a wide
                    range of products and make purchases through a secure and user-friendly online platform. Whether you are
                    a consumer looking for the latest products or a business looking to expand your customer base, Hatela
                    Ecom offers a convenient and accessible solution.</p>
            </div>
        </div>
        <div class="py-5">
            <div class="justify-content-center">

                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <h4>Trending Product</h4>
                            <div class="underline mb-4">

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="py-2">
            <div class="container">
                <div class="row">

                    {{-- copy from product/index --}}

                    @if ($trendingProducts)

                        <div class="col-md-12 trending-product owl-carousel owl-theme">

                            @foreach ($trendingProducts as $productItem)
                                <div class="col-md-6">
                                    <div class="product-card">

                                        <div class="product-card-img">

                                            <label class="stock bg-danger">New</label>

                                            @if ($productItem->ProductImage->count() > 0)
                                                <a
                                                    href="{{ url('/collection/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                                    <img style=" width: 130%; height: 250px;" src="{{ asset($productItem->ProductImage[0]->image) }}"
                                                        alt=" {{ $productItem->name }}">
                                                </a>
                                            @endif
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
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <div class="p-4">
                                    <h1>No Product Available </h1>
                                </div>
                            </div>
                    @endif



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
