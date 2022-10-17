<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Direct Order List Page
    public function orderList(){
        $data = Order::select('orders.*','users.name')
        ->when(request('search'),function($dt){
            $dt->where('orders.status','like','%'.request('search').'%');
        })
        ->join('users','orders.user_id','users.id')
        ->paginate(4);
        return view('admin.order.list',compact('data'));
    }

    // status update
    public function updateStatus(Request $request){
        Order::where('id',$request->id)->update(['status'=>$request->status]);
        return response()->json(['status'=>'success'],200);
    }

    // Order Info
    public function orderInfo($orderCode){
        $order = Order::where('order_code',$orderCode)->get();
        $data = OrderList::select('order_lists.*','users.name as user_name','products.name as product_name','products.image','products.price')
                ->where('order_code',$orderCode)
                ->join('users','users.id','order_lists.user_id')
                ->join('products','products.id','order_lists.product_id')
                ->paginate(3);
                return view('admin.order.orderInfo',compact('data','order'));
    }
}
