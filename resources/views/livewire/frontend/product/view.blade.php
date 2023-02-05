 <div>

     <div class="py-3 py-md-5 bg-light">
         <div class="container">
            {{-- {{-- @if (session('message'))
            <div class="text-success ">
                {{session('message')}}
            </div>

            @endif --}}
             <div class="row">
                 <div class="col-md-5 mt-3">
                     <div wire:ignore class="bg-white border">
                         @if ($product->ProductImage)
                         {{-- for single image  --}}
                             {{-- <img src="{{ asset($product->ProductImage[0]->image) }}" class="w-100" alt="Img"> --}}

                             {{-- for multiple image   using exzoom  --}}
                             <div class="exzoom" id="exzoom">
                                <!-- Images -->
                                <div class="exzoom_img_box">
                                  <ul class='exzoom_img_ul'>
                                    @foreach ($product->ProductImage as $itemImg )

                                    <li><img src="{{ asset($itemImg->image) }}"/></li>
                                    @endforeach

                                  </ul>
                                </div>
                                <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                                <div class="exzoom_nav"></div>
                                <!-- Nav Buttons -->
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                              </div>
                         @else{
                             No Image Found
                             }
                         @endif
                     </div>
                 </div>
                 <div class="col-md-7 mt-3">
                     <div class="product-view">
                         <h4 class="product-name">
                             {{ $product->name }}

                         </h4>
                         <hr>
                         <p class="product-path">
                             Home / {{ $product->category->name }} / {{ $product->name }}
                         </p>
                         <div>
                             <span class="selling-price">{{ $product->selling_price }}</span>
                             <span class="original-price">{{ $product->original_price }}</span>
                         </div>
                         {{-- for color --}}
                         <div>
                             @if ($product->productColors->count() > 0)
                                 @if ($product->ProductColors)
                                     @foreach ($product->ProductColors as $ColorItem)
                                         {{-- for simple show the color in product  --}}
                                         {{-- <input type="radio" name="colorSelection"
                                        value="{{ $ColorItem->id }}">{{ $ColorItem->color->name }} --}}
                                         <label style="background-color: {{ $ColorItem->color->code }}"
                                             class="colorSelectionLabel text-white"
                                             wire:click="colorSelected({{ $ColorItem->id }})">{{ $ColorItem->color->name }}</label>
                                     @endforeach
                                 @endif


                                 <div>
                                     @if ($this->productColorSelectedQuantity == 'outOfStock')
                                         <label class="btn-sm py-1 mt-2 text-white bg-danger">Out Of Stock</label>
                                     @elseif ($this->productColorSelectedQuantity > 0)
                                         <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                     @endif
                                 @else
                                     @if ($product->quantity)
                                         <label class="btn-sm py-1 mt-2 text-white bg-success">In Stock</label>
                                     @else
                                         <label class="btn-sm py-1 mt-2 text-white bg-danger">Out Of Stock</label>
                                     @endif
                             @endif

                         </div>
                     </div>
                     {{-- for quantity --}}
                     <div class="mt-2">
                         <div class="input-group">
                             <span wire:click="decrementQuantity" class="btn btn1"><i class="fa fa-minus"></i></span>
                             <input wire:model="quantityCount" readonly type="text" value="{{$this->quantityCount}}" class="input-quantity  " />
                             <span wire:click="incrementQuantity" class="btn btn1"><i class="fa fa-plus"></i></span>
                         </div>
                     </div>
                     <div class="mt-3">

                         <button type="button" wire:click="addToCart({{$product->id}})" class="btn btn1">
                             <i class="fa fa-shopping-cart"></i> Add To Cart</button>


                         <button type="button" wire:click="addToWishList({{$product->id}})"  class="btn btn1">
                            <span wire:loading.remove  wire:target="addToWishList">
                                {{-- for make the wishlist loading in instance by livewire --}}
                                <i class="fa fa-heart"></i> Add To Wishlist
                            </span>
                            <span wire:loading wire:target="addToWishList">Adding...   </span>
                        </button>
                     </div>
                     <div class="mt-3">
                         <h5 class="mb-0">Small Description</h5>
                         <p>
                             {!! $product->small_description !!} </p>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-12 mt-3">
                 <div class="card">
                     <div class="card-header bg-white">
                         <h4>Description</h4>
                     </div>
                     <div class="card-body">
                         <p>
                             {!! $product->description !!}
                         </p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 </div>
 @push('script')
     <script>
        $(function(){

$("#exzoom").exzoom({

  // thumbnail nav options
  "navWidth": 60,
  "navHeight": 60,
  "navItemNum": 5,
  "navItemMargin": 7,
  "navBorder": 1,

  // autoplay
  "autoPlay": false,

  // autoplay interval in milliseconds
  "autoPlayTimeout": 2000

});

});
     </script>
 @endpush
