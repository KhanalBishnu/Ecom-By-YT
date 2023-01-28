<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;

class Index extends Component
{
    public $category,$product;
    public function mount($category,$product){
       $category=$this->category;
       $product=$this->product;
    }
    public function render()
    {
        return view('livewire.frontend.product.index',[
            'category'=> $this->category,
            'product'=> $this->product,
        ]);
    }
}
