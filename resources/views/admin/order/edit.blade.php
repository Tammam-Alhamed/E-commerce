@extends('layouts.admin')
@section('content')
<div class="container mt-5 mb-5">

    <div class="row d-flex justify-content-center">

        <div class="col-md-8">

            <div class="card">


                    <div class="text-left logo p-2 px-5">

                        <img src="https://i.imgur.com/2zDU056.png" width="50">
                        

                    </div>

                    <div class="invoice p-5">

                        <h5>
                            حالة الطلب :@if($order->orders_status == "0") في انتظار الموفقه @endif
                                        @if($order->orders_status == "1") يتم تحضير الطلب @endif
                                        @if($order->orders_status == "2") جاهز للاستلام من قبل مندوب التوصيل @endif
                                        @if($order->orders_status == "3") علي الطريق @endif
                                        @if($order->orders_status == "4") تم انجاز الطلب @endif
                             !</h5>

                        <span class="font-weight-bold d-block mt-4">اسم المستخدم : {{$users->name}} </span>
                        <span>بريد المستخدم : {{$users->email}}</span>
                        <br>
                        <span>هاتف المستخدم : {{$users->phone}}</span>

                        <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">

                            <table class="table table-borderless">
                                
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="py-2">

                                                <span class="d-block text-muted">تاريخ الطلب</span>
                                                <span>{{$orders_view[0]->orders_datetime}}</span>
                                                
                                            </div>
                                        </td>

                                        <td>
                                            <div class="py-2">

                                                <span class="d-block text-muted">رقم الطلب</span>
                                                <span>{{$orders_view[0]->orders_id}}</span>
                                                
                                            </div>
                                        </td>

                                        <td>
                                            <div class="py-2">

                                                <span class="d-block text-muted">Payment</span>
                                            <span><img src="https://img.icons8.com/color/48/000000/mastercard.png" width="20" /></span>
                                                
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                            <div class="product border-bottom table-responsive">

                                <table class="table table-borderless">
                                    @foreach ($orders as $order)
                                <tbody>
                                    <tr>
                                    <td width="20%">
                                        <img src="{{URL('Bazar/items/'.$order->items_image_main)}}" width="90"/>
                                    </td>
                                    <td width="60%">
                                        <span class="font-weight-bold">{{$order->items_name}}</span>
                                        <div class="product-qty">
                                            <span class="d-block">الكميه:{{$order->countitems}}</span>
                                            <span>اللون:  {{$order->cart_colors}}</span>
                                            <br>
                                            <span>المقاس:  {{$order->cart_sizes}}</span>
                                            
                                        </div>
                                    </td>
                                    <td width="20%">
                                        <div class="text-right">
                                            <span class="font-weight-bold">{{$order->itemsprice_d}} ل.س</span>
                                        </div>
                                        <br>
                                        <a href="{{route('admin.order.show',$order->cart_id)}}">
                                            <span class="btn  btn-outline-success btn-sm font-1 mx-1">
                                                <span class="fas fa-wrench "></span> تحكم
                                            </span>
                                        </a>
                                    </td>
                                    
                                    </tr>
                                </tbody> 
                                @endforeach
                                    
                                </table>
                                


                            </div>



                            <div class="row d-flex justify-content-end">

                                <div class="col-md-5">

                                    <table class="table table-borderless">

                                        <tbody class="totals">

                                            <tr>
                                                <td>
                                                    <div class="text-left">

                                                        <span class="text-muted"> سعر المنتجات </span>
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span>{{$orders_view[0]->orders_price_d}}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                             <tr>
                                                <td>
                                                    <div class="text-left">

                                                        <span class="text-muted">رقم الكوبون</span>
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span>{{$orders_view[0]->orders_coupon}}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                             <tr class="border-top border-bottom">
                                                <td>
                                                    <div class="text-left">

                                                        <span class="font-weight-bold">السعر الكلي</span>
                                                        
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-right">
                                                        <span>{{$orders_view[0]->orders_totalprice_d}}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                                


                            </div>
                    </div>

                    <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('update_order',$orders_view[0]->orders_id)}}" >
                        @csrf
                        @method('PUT')
                    <div class="col-12 p-3 ">
                        <div class="col-12">
                            حاله الطلب
                        </div>
                        <div class="col-12 pt-3">
                            <select  class="form-control" name="orders_status" required>
                                <option @if($orders_view[0]->orders_status == "0") selected @endif value="0" > في انتظار الموافقه</option>
                                <option @if($orders_view[0]->orders_status == "1") selected @endif value="1" >يتم تحضير الطلب </option>
                                <option @if($orders_view[0]->orders_status == "2") selected @endif value="2" >طلبك جاهز للاستلام-ارسل اليك </option>
                                <option @if($orders_view[0]->orders_status == "3") selected @endif value="3" >شكرا للتسوق في بازار </option>
                                <option @if($orders_view[0]->orders_status == "4") selected @endif value="4" >أرشيف</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-12 p-3">
                        <div class="col-12 col-lg-12 p-0 ">
                                    <div class="col-12 p-3 row">
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            الاشعار عربي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body"  maxlength="190" class="form-control">
                                        </div>
                                    </div>
                    
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            الاشعار اجنبي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body_en"  maxlength="190" class="form-control">
                                        </div>
                                    </div>
                    
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            الاشعار روسي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body_ru" maxlength="190" class="form-control" >
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                        </div>
                    </div>
                </div>
            </form>




        
    </div>
            
        </div>
        
    </div>
    
</div>
@endsection