<?php

namespace App\Http\Controllers;
use App\Models\cart;
use App\Models\item;
use App\Models\User;
use App\Models\orders;
use App\Models\ordersview;
use Illuminate\Http\Request;
use App\Models\PushNotification;
use App\Models\ordersdetailsview;
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


    public function show($id)
    {
        // $item = DB::table('ordersdetailsview')
        // ->select('*')
        // ->where('cart_id'  , $id)
        // ->get();


        $item = ordersdetailsview::where('cart_id' , $id)->first();
        return view('admin.order.item' , compact('item'));
    }


    public function edit( $cart_orders)
    {

       $orders = DB::table('ordersdetailsview')
                    ->select('*')
                    ->where('cart_orders'  , $cart_orders)
                    ->get();

    $order = orders::find($cart_orders );
    $order->update([
        'orders_read' => '1'
    ]);
    $users = User::find($order->orders_usersid);

    $orders_view = DB::table('ordersview')
    ->select('*')
    ->where('orders_id'  , $cart_orders)
    ->get();
    
    // Notification::send($users, new Order($order->orders_usersid));

        return view('admin.order.edit' , compact('orders' , 'order' , 'users' , 'orders_view' ) );    
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
    
    $item_name = item::find($item->cart_itemsid);
    $item->cart_status = $request->input('cart_status');
    $item->update();
    $this->fm("users".$item->cart_usersid , "статус элемента" , "ваш товар ($item_name->items_name) в номере заказа ($item->cart_orders) обновлен
$request->body_ru" );

    $comment = new PushNotification();
    $comment->notification_title = "статус элемента";
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
    if ($request->orders_status == "0") {
       $status = "Ожидание подтверждения";
    }elseif($request->orders_status == "1"){
        $status = "Заказ готовится";
    }elseif($request->orders_status == "2"){
        $status = "Ваш заказ готов к самовывозу — отправлен вам";
    }elseif($request->orders_status == "3"){
        $status = "Спасибо за покупки в Базаре";
    }elseif($request->orders_status == "4"){
        $status = "Архив";
    }


    $order = orders::find($orderid);
    $order->orders_status = $request->input('orders_status');
    $order->update();
    $this->fm("users".$order->orders_usersid , "статус заказа" , "Статус номера вашего заказа ($order->orders_id) изменен на $status
$request->body_ru" );

    
    $comment = new PushNotification();
    $comment->notification_title = "статус заказа";
    $comment->notification_body_en = "your order number ($order->orders_id) status has been updated
    ".$request->body_en;
    $comment->notification_body = "تم تحديث حالة الطلب رقم ($order->orders_id) الخاص بك
    ".$request->body;
    $comment->notification_body_ru = "Статус номера вашего заказа ($order->orders_id) обновлен
    ".$request->body_ru;
    $comment->notification_userid = $order->orders_usersid;
    $comment->save();

        return redirect()->back();

    }


    public function destroy( $orders)
    {
        $orders = orders::find($orders);
        $orders->delete();
        flash()->success('تم حذف الطلب بنجاح','عملية ناجحة');
        return redirect()->route('admin.order.index');
    }
    
}
