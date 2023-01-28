<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];//this is livewire event Event Listeners
    // give the parameter the sam name of emit and the function name
    public $wishlistCount;
    public function checkWishlistCount(){
        if(Auth::check()){
            return $this->wishlistCount=Wishlist::where('user_id',auth()->user()->id)->count();
            //this gives the count number for count variable $wishlistCount
        }else{
            return $this->wishlistCount=0;
        }
    }

    public function render()
    {
        $this->wishlistCount=$this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count',[
            'wishlistCount'=>$this->wishlistCount
        ]);
    }
}
