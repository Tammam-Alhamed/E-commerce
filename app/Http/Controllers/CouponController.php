<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = coupon::all();
        return view('admin.coupon.index' , compact('coupons'));
    }


    public function create()
    {
        return view('admin.coupon.create');
    }


    public function store(Request $request)
    {
        $dateTime = Carbon::parse($request->coupon_expiredate);
        // dd($request['coupon_expiredate'] = $dateTime->format('Y-m-d H:i:s'));
        
        $coupons = coupon::create([
            'coupon_name' => $request->coupon_name,
            'coupon_count' => $request->coupon_count,
            'coupon_discount' => $request->coupon_discount,
            'coupon_expiredate' => $request['your_datetime_field'] = $dateTime->format('Y-m-d H:i:s'),
        ]);
        return redirect()->route('admin.coupon.index');
    }


    public function show(coupon $coupon)
    {
        //
    }


    public function edit( $coupon)
    {
        $coupons = coupon::find($coupon);
        return view('admin.coupon.edit' , compact('coupons'));
    }


    public function update(Request $request, coupon $coupon)
    {
        $dateTime = Carbon::parse($request->coupon_expiredate);
        $coupon->update([
            'coupon_name' => $request->coupon_name,
            'coupon_count' => $request->coupon_count,
            'coupon_discount' => $request->coupon_discount,
            'coupon_expiredate' => $request['your_datetime_field'] = $dateTime->format('Y-m-d H:i:s'),
        ]);
        return redirect()->back();
    }

    public function destroy(coupon $coupon)
    {

        $coupon->delete();
        flash()->success('تم حذف الطلب بنجاح','عملية ناجحة');
        return redirect()->route('admin.coupon.index');
    }
}
