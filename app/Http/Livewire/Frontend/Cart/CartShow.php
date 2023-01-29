<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart;
    public function render()
    {
        $this->cart=Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',[
            'cart'=>$this->cart
        ]);
    }
    public function incrementQuantity(int $cartId){
        $cartData=Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->ProductColor()->where('id',$cartData->product_color_id)->exists()){
                 $productColor=$cartData->ProductColor()->where('id',$cartData->product_color_id)->first();
                 if($productColor->quantity >$cartData->quantity){
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Quantity Updated',
                        'type'=>'success',
                        'status'=>200
                    ]);
                 }
                 else{
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Only '.$productColor->quantity.' Quantity Available',
                        'type'=>'info',
                        'status'=>200
                    ]);
                 }
            }
            else{
                if($cartData->product->quantity >$cartData->quantity){
                    $cartData->increment('quantity');
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Quantity Updated',
                        'type'=>'success',
                        'status'=>200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Only '.$cartData->product->quantity.' Quantity Available',
                        'type'=>'info',
                        'status'=>200
                    ]);
                }
            }

        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Something went Wrong!',
                'type'=>'error',
                'status'=>404
            ]);
        }
    }

    public function decrementQuantity(int $cartId){
        $cartData=Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->ProductColor()->where('id',$cartData->product_color_id)->exists()){
                 $productColor=$cartData->ProductColor()->where('id',$cartData->product_color_id)->first();
                 if($productColor->quantity >$cartData->quantity){
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Quantity Updated',
                        'type'=>'success',
                        'status'=>200
                    ]);
                 }
                 else{
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Only '.$productColor->quantity.' Quantity Available',
                        'type'=>'info',
                        'status'=>200
                    ]);
                 }
            }
            else{
                if($cartData->product->quantity >$cartData->quantity){
                    $cartData->decrement('quantity');
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Quantity Updated',
                        'type'=>'success',
                        'status'=>200
                    ]);
                }
                else{
                    $this->dispatchBrowserEvent('message',[
                        'text'=>'Only '.$cartData->product->quantity.' Quantity Available',
                        'type'=>'info',
                        'status'=>200
                    ]);
                }
            }

        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Something went Wrong!',
                'type'=>'error',
                'status'=>404
            ]);
        }
    }
    public function removeCart(int $cartId){
        $cartRemove=Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->first();
        if($cartRemove){
            $cartRemove->delete();
            $this->emit('cartAddedUpdated');
            $this->dispatchBrowserEvent('message',[
                'text'=>'Cart Item successfully Removed',
                'type'=>'success',
                'status'=>200
            ]);
        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Something went Wrong!',
                'type'=>'error',
                'status'=>404
            ]);
        }

    }
}
