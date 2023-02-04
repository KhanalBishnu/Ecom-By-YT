<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(){
        $today=Carbon::now();
        $orders=Order::whereDate('created_at',$today)->paginate(10);
        return view('admin.order.index',compact('orders'));
    }

    public function show(int $orderId){
        $orders=Order::where('id',$orderId)->first();
        if($orders){
        return view('admin.order.view',compact('orders'));
        }
        else{
            return redirect('admin/order')->with('message','Order Id Not Found');
        }
    }
}
