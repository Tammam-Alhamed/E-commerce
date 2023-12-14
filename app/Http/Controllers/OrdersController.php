<?php

namespace App\Http\Controllers;



use App\Models\cart;
use App\Models\orders;
use App\Models\item;
use App\Models\ordersdetailsview;
use App\Models\ordersview;
use App\Models\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{

    public function index()
    {
        $order = ordersview::all();
        // $order = orders::all();
        return view('admin.order.index' , compact('order'));
    }


    public function create()
    {
        //  
    }


    public function store(Request $request)
    {
        //
    }


    public function show(orders $orders)
    {
        // 
    }


    public function edit( $cart_orders)
    {

       $orders = DB::table('ordersdetailsview')
                    ->select('*')
                    ->where('cart_orders'  , $cart_orders)
                    ->get();

    $order = orders::find($cart_orders );

        return view('admin.order.edit' , compact('orders' , 'order') );    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $cart_id )
    {



    $item = cart::find($cart_id);
    $item->cart_status = $request->input('cart_status');
    $item->update();

    $this->fm("users".$item->cart_usersid , "order" , "your item hase been updated" );

    $comment = new PushNotification();
    $comment->notification_title = "order";
    $comment->notification_body_en = "your item status has been updated
".$request->body_en;
    $comment->notification_body = "تم تحديث حالة المنتج الخاص بك
".$request->body;
    $comment->notification_body_ru = "статус вашего товара обновлен
".$request->body_ru;
    $comment->notification_userid = $item->cart_usersid;
    $comment->save();
        return redirect()->back();

    }

    public function update_order(Request $request , $orderid )
    {
    //    $requests = $request->items_status;

    //    $items_id = DB::table('ordersdetailsview')
    //    ->select('items_id')
    //    ->get();

    //    $order = DB::table('item')
    //     ->where('items_id', $items_id )
    //     ->update(['title' => $requests]);

    //     $order->save();

    $order = orders::find($orderid);
    $order->orders_status = $request->input('orders_status');
    $order->update();
    $this->fm("users".$order->orders_usersid , "order" , "your order status has been updated" );

    
    $comment = new PushNotification();
    $comment->notification_title = "order";
    $comment->notification_body_en = "your order status has been updated
    ".$request->body_en;
    $comment->notification_body = "تم تحديث حالة المنتج الخاص بك
    ".$request->body;
    $comment->notification_body_ru = "статус вашего товара обновлен
    ".$request->body_ru;
    $comment->notification_userid = $order->orders_usersid;
    $comment->save();

        return redirect()->back();

    }


    public function destroy(orders $orders)
    {
        //
    }
    
}
