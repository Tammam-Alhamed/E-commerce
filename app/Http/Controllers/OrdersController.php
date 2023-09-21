<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\ordersdetailsview;
use App\Models\ordersview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = ordersview::all();
        // $order = orders::all();
        return view('admin.order.index' , compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(orders $orders)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit( $orders_usersid)
    {

    //    $order = DB::table('ordersdetailsview')
    //                 ->select('*')
    //                 ->where('cart_orders' ,'=' , $orders_usersid)
    //                 ->first();
    $order = ordersdetailsview::find($orders_usersid);

        return view('admin.order.edit' , compact('order') );    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, orders $orders)
    {
        if(!auth()->user()->has_access_to('update',$orders))abort(403);
        $orders->update([
            'items_name' => $request->items_name,
        ]);
        return redirect()->route('admin.item.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(orders $orders)
    {
        //
    }
}
