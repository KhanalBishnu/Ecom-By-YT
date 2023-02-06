<?php

namespace App\Http\Controllers\Front;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(){
        $sliders=Slider::where('status','0')->get();
        $trendingProducts=Product::where('trending','1')->latest()->take(15)->get();
        return view('frontend.index',compact('sliders','trendingProducts'));
    }

    public function category(){
        $categories=Category::where('status','0')->get();
        return view('frontend.category.index',compact('categories'));
    }

    public function product($category_slug){
        $category=Category::where('slug',$category_slug)->first();
        if($category){
            $product=$category->products()->get();
             return view('frontend.product.index',compact('product','category'));


        }else{
            return redirect()->back();
        }
    }
    public function productView(string $category_slug , string $product_slug){

        $category=Category::where('slug',$category_slug)->first();
        if($category){

            $product = $category->products()->where('slug',$product_slug)->where('status','0')->first();
            if($product){

             return view('frontend.product.view',compact('product','category'));

            }else{
                return redirect()->back();
            }

        }else{
            return redirect()->back();
        }
    }
    public function thankyou(){
        return view('frontend.thankyou');
    }

    public function newArrival(){
        $newArrivalProducts=Product::latest()->take(15)->get();
        return view('frontend.newArrival.index',compact('newArrivalProducts'));

    }
    public function featuredProduct(){
        $featuredProduct=Product::where('featured','1')->latest()->take(15)->get();
        return view('frontend.featuredProduct.index',compact('featuredProduct'));

    }
}
