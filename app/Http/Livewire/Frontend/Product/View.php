<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    //for declare the $category and $product in livewire

    public $category,$product,$productColorSelectedQuantity,$quantityCount=1,$productColorId;

    public function colorSelected($productColorId){
        //for productColorId
        $this->productColorId=$productColorId;
        // dd($productColorId);for check the id of color and product

        $productColor=$this->product->ProductColors()->where('id',$productColorId)->first();
        $this->productColorSelectedQuantity=$productColor->quantity;

        if($this->productColorSelectedQuantity==0){
            $this->productColorSelectedQuantity='outOfStock';
        }
    }
    public function mount($category,$product){
        $this->category=$category;
        $this->product=$product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'product'=> $this->product,
        ]);
    }
    public function addToWishList($productId){
        // dd($productId);for check product id
        if(Auth::check()){
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()){

                session()->flash('message','Already Added to Wishlist');
                    // for notifire to show
                $this->dispatchBrowserEvent('message', [
                'text'=>'Already Added to Wishlist',
                'type'=>'success',
                'status'=>409,
                // type and status optional if u want
            ]);
                return false;
            }
            else{
                Wishlist::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$productId,
                ]);
                session()->flash('message', 'Added to Wishlist SuccessFully');
                $this->emit('wishlistAddedUpdated');
                // if we added the wishlist it also increment by emit to Firing Events(livewire)

                    // for notifire to show
            $this->dispatchBrowserEvent('message', [
                'text'=>'Added to Wishlist SuccessFully',
                'type'=>'success',
                'status'=>'200',
                // type and status optional if u want
            ]);

            }
        }else{
            session()->flash('message','Please Login to continue');
            // for notifire to show
            $this->dispatchBrowserEvent('message', [
                'text'=>'Please Login to continue',
                'type'=>'info',
                'status'=>'401',
                // type and status optional if u want
            ]);

            return false;

        }
    }
    public function incrementQuantity(){
        if($this->quantityCount <10){
            $this->quantityCount++;
        }
    }
    public function decrementQuantity(){
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
    }
    public function addToCart(int $productId){
        if(Auth::check()){
            //dd($productId);check for product id come or not
            if($this->product->where('id',$productId)->where('status','0')->exists()){
                //check for product exists or not
                if($this->product->ProductColors()->count() >1){
                    if($this->productColorSelectedQuantity !=NULL){
                        if(Cart::where('user_id',auth()->user()->id)
                        ->where('product_id',$productId)
                        ->where('product_color_id',$this->productColorId)
                        ->exists()){
                            $this->dispatchBrowserEvent('message',[
                                'text'=>'Already Added To Cart',
                                'type'=>'info'
                            ]);
                        }
                        else{

                            $productColor=$this->product->ProductColors()
                            ->where('id',$this->productColorId)->first();
                            if($productColor->quantity>0){
                                if($productColor->quantity>$this->quantityCount){
                                    //insert the corol with product to cart
                                    Cart::create([
                                        'user_id'=>auth()->user()->id,
                                        'product_id'=>$productId,
                                        'product_color_id'=>$this->productColorId,
                                        'quantity'=>$this->quantityCount
                                    ]);
                                    $this->emit('cartAddedUpdated');//for show the count
                                    $this->dispatchBrowserEvent('message',[
                                        'text'=>'Product Added to Cart',
                                        'type'=>'success'
                                    ]);

                                }
                                else{
                                    $this->dispatchBrowserEvent('message',[
                                        'text'=>'Only'.$productColor->quantity.' Quantity Available',
                                        'type'=>'info'
                                    ]);
                                }
                            }
                            else{
                                $this->dispatchBrowserEvent('message',[
                                    'text'=>'Out of Stock for Color',
                                    'type'=>'info'
                                ]);
                            }
                        }
                    }
                    else{
                        $this->dispatchBrowserEvent('message',[
                            'text'=>'Select Your Color',
                            'type'=>'info'
                        ]);
                    }
                }
                else{
                    if($this->product->quantity >0){
                        if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)
                        ->exists()){
                            $this->dispatchBrowserEvent('message',[
                                'text'=>'Already Added To Cart',
                                'type'=>'info'
                            ]);
                        }
                        else{

                            if($this->product->quantity >$this->quantityCount){
                                //Insert into cart without color
                                Cart::create([
                                    'user_id'=>auth()->user()->id,
                                    'product_id'=>$productId,
                                    'quantity'=>$this->quantityCount
                                ]);
                                $this->emit('cartAddedUpdated');
                                $this->dispatchBrowserEvent('message',[
                                    'text'=>'Product Added to Cart',
                                    'type'=>'success'
                                ]);

                            }
                            else{
                                $this->dispatchBrowserEvent('message',[
                                    'text'=>'Only'.$this->product->quantity.'Quantity Available',
                                    'type'=>'info'
                                ]);
                            }
                           }

                    }
                    else{
                        $this->dispatchBrowserEvent('message',[
                            'text'=>'Out Of Stock',
                            'type'=>'info'
                        ]);
                    }
                }


            }
            else{
                $this->dispatchBrowserEvent('message',[
                    'text'=>'Product Doesnot Exists',
                    'type'=>'danger'
                ]);
            }
        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Please login First',
                'type'=>'info'
            ]);
        }
    }
}
