<?php

namespace App\Http\Livewire\Admin\Brand;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Brand;


class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $brand_id;
    public function render()
    {
        $brands=Brand::orderBy('id','DESC')->paginate(10);

        return view('livewire.admin.brand.index',['brands'=>$brands]);
    }
}
