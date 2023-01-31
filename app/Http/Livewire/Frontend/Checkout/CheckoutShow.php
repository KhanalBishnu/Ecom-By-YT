<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;

class CheckoutShow extends Component
{
    public $totalproductAmount=0;
    public $fullname,$email,$phone,$pincode,$address;//form model
    public $payment_mode=NULL,$payment_id=NULL;//for order and order Item
    public function render()
    {
        $this->fullname=auth()->user()->name;//for sent name of user
        $this->email=auth()->user()->email;//sent email when page loaded
        $this->totalproductAmount=$this->totalproductAmount();
        return view('livewire.frontend.checkout.checkout-show',[
            'totalproductAmount'=>$this->totalproductAmount
        ]);
    }
// for total amount which is user used to cart to buy and load the total price when page reload by passing the variable /
    public function totalproductAmount(){
       $this->cart= Cart::where('user_id',auth()->user()->id)->get();
       $this->totalproductAmount=0;
       foreach ($this->cart as  $cartItem) {
        $this->totalproductAmount+= $cartItem->quantity*$cartItem->product->selling_price;
       }
       return $this->totalproductAmount;

    }
    //for validation attributes
    public function rules(){
        return [
        'fullname'=>'required|string',
        'email' =>'required|string',
        'phone' =>'required|string',
        'pincode' =>'required|integer',
        'address' =>'required|string',
        ];
    }
    public function placeOrder(){
        $this->validate();
        $order=Order::create([
            'user_id'=>auth()->user()->id,
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'pincode'=>$this->pincode,
            'address'=>$this->address,
            'status_message'=>'in progress',
            'payment_mode'=>$this->payment_mode,
            'payment_id'=>$this->payment_id,
        ]);
        foreach ($this->cart as  $cartItem) {

           $orderItem=OrderItem::create([
            'order_id'=>$order->id,
            'product_id'=>$cartItem->product_id,
            'product_color_id'=>$cartItem->product_color_id,
            'quantity'=>$cartItem->quantity,
            'price'=>$cartItem->product->selling_price,
           ]);
        }
        //for quantity decrement when the order placed successfull in product quantity
        if($cartItem->product_color_id!=NULL){
            $cartItem->ProductColor()->where('id',$cartItem->product_color_id)->decrement('quantity',$cartItem->quantity);
        }
        else{
            $cartItem->product()->where('id',$cartItem->product_id)->decrement('quantity',$cartItem->quantity);
        }
        return $order;
    }
    public function codOrder(){
        //same name in blade file wire:click="codOrder" for cash on delivery
        $this->payment_mode='cash on delivery';
        $codOrder=$this->placeOrder();
        if($codOrder){
            Cart::where('user_id',auth()->user()->id)->delete();
            session()->flash('message','Order Placed Successfully');//for thank you page to show message
            $this->dispatchBrowserEvent('message',[
                'text'=>'Order Placed Successfully',
                'type'=>'success',
                'status'=>200
            ]);
            return redirect()->to('thankyou');

        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'Something went Wrong!',
                'type'=>'error',
                'status'=>500
            ]);
        }
    }
}
