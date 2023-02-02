<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $orders=Order::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->paginate(5);
        return view('frontend.order.index',compact('orders'));
    }

    public function view($orderId){
        $orders=Order::where('user_id',auth()->user()->id)->where('id',$orderId)->first();
                if($orders){

                return view('frontend.order.view',compact('orders'));
             }
             else{
                return redirect()->back()->with('message','No Order Found');
             }
    }

}
