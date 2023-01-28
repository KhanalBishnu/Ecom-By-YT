<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistShow extends Component
{
    public function render()
    {
        $wishlist= Wishlist::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.wishlist-show',[
            'wishlist'=>$wishlist ,
        ]);
    }
    public function removeWishlistItem(int $wishlistId){
        // dd($wishlistId); for check
        Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        // for dynamic changes forwishlist and you can give parameter name anything
        $this->dispatchBrowserEvent('message',[
            'text'=>'Wishlist Remove Successfully',
            'type'=>'success',
            'status'=>200
        ]);
    }
}
