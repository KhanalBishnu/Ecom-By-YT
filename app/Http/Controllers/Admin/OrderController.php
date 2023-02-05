<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){
        // $today=Carbon::now();
        // $orders=Order::whereDate('created_at',$today)->paginate(10);

        // for filter by status and created date
        $todayDate=Carbon::now()->format('y-m-d');
        $orders=Order::when($request->date !=NULL,function ($q) use($request){
            return $q->whereDate('created_at',$request->date);
        },function ($q) use($todayDate){
            return $q->whereDate('created_at',$todayDate);
            // if date rakhera filter gate request ko dekhaune if not then aajako date dekhaune
        })
        ->when($request->status !=Null,function($q) use($request){
            return $q->where('status_message',$request->status);
            // if request ma status aako xa vane tei anisar dekhaune natra pardaina
        })->paginate(10);
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
    public function updateStatus(int $orderId,Request $request){
        $orders=Order::where('id',$orderId)->first();
        if($orders){
            $orders->update([
                'status_message'=>$request->order_status
                //order_status is name of select in html
            ]);
            return redirect('admin/order/'.$orderId)->with('message','Order Updated Successfully');
            }
            else{
                return redirect('admin/order/'.$orderId)->with('message','Order Id Not Found');
            }
    }
}
