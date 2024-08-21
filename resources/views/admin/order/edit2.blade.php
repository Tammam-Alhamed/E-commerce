@extends('layouts.admin')
@section('content')
<div class="col-8 p-3">
    <div class="col-12 col-lg-12 p-0 ">

            <div class="col-12 col-lg-8 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fas fa-info-circle"></span> اضافه منتج
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                    <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('update_order',$order->orders_id)}}" >
                        @csrf
                        @method('PUT')
                    <div class="col-12 col-lg-6 p-2 ">
                        <div class="col-12">
                            حاله الطلب
                        </div>
                        <div class="col-12 pt-3">
                            <select  class="form-control" name="orders_status" required>
                                <option @if($order->orders_status == "0") selected @endif value="0" > في انتظار الموافقه</option>
                                <option @if($order->orders_status == "1") selected @endif value="1" >يتم تحضير الطلب </option>
                                <option @if($order->orders_status == "2") selected @endif value="2" >جاهز للاستلام من قبل مندوب التوصيل </option>
                                <option @if($order->orders_status == "3") selected @endif value="3" >علي الطريق </option>
                                <option @if($order->orders_status == "4") selected @endif value="4" >تم انجاز الطلب </option>
                            </select>
                        </div>
                        <div class="col-12 divider" style="min-height: 2px;"></div>
                        <br>
                        <div class="col-12">
                            <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                        </div>
                    </div>

    
                    <div>
                        _________________________________________________
                        <br>
                    </div>
                    
                    <div class="col-12 p-3">
                        <div class="col-12 col-lg-12 p-0 ">
                                    <div class="col-12 p-3 row">
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            المضمون عربي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body"  maxlength="190" class="form-control" value="{{old('body')}}">
                                        </div>
                                    </div>
                    
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            المضمون اجنبي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body_en"  maxlength="190" class="form-control" value="{{old('body_en')}}">
                                        </div>
                                    </div>
                    
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            المضمون روسي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body_ru" maxlength="190" class="form-control" value="{{old('body_ru')}}">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </form>
                    {{-- <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            التصنيف
                        </div>
                        <div class="col-12 pt-3">
                            <select class="form-control" name="orders_cat" required>
                                @foreach($categorie as $categorie)
                                <option selected value="{{$categorie->categories_id}}">{{$categorie->categories_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}



                    {{-- <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                           الموظف
                        </div>
                        <select class="form-control" name="auther_id" required>
                            <option value selected disabled hidden>إختر الموظف</option>
                            @foreach($auther as $auther)
                            <option value="{{$auther->id}}" @if($tran->auther_id==$auther->id) selected @endif>{{$auther->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}


                
                        
                 
                <div class="col-9 p-3 row">
                    @foreach ($orders as $order)
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            السعر الكلي
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="orders_name_ar"  value="{{$order->itemsprice_d}}  ل.س" required maxlength="190" class="form-control" >
                        </div>
                    </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                             اسم المنتج
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="orders_discount" value="{{$order->items_name}}" required maxlength="190" class="form-control" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                سعر المنتج الواحد
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="countitems" value="{{$order->items_price_d}} $" required maxlength="190" class="form-control" >
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الكمية
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="countitems" value="{{$order->countitems}}" required maxlength="190" class="form-control" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الخصم المطبق
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="countitems" value="{{$order->items_discount}}%" required maxlength="190" class="form-control" >
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الصوره
                            </div>
                            <div>
                                 <img src="{{URL('Bazar/items/'.$order->items_image_main)}}" alt="*image" style="width: 300px;"/>
                            </div>
                        </div>
                        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.order.update',$order->cart_id)}}" >
                            @csrf
                            @method('PUT')
                        @if ($order->items_delay == 1)
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                حاله المنتج
                            </div>
                            <div class="col-12 pt-3">
                                <select  class="form-control" name="cart_status" required>
                                    <option @if($order->cart_status == "0") selected @endif value="0" > في انتظار الموافقه</option>
                                    <option @if($order->cart_status == "1") selected @endif value="1" >يتم تحضير الطلب </option>
                                    <option @if($order->cart_status == "2") selected @endif value="2" >جاهز للاستلام من قبل مندوب التوصيل </option>
                                    <option @if($order->cart_status == "3") selected @endif value="3" >علي الطريق </option>
                                    <option @if($order->cart_status == "4") selected @endif value="4" >تم انجاز الطلب </option>
                                </select>
                            </div>
                        </div>
                        
                        
                                <div  class="card" style="width: 450px;">
                                    <div class="col-12 p-3 ">
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            الاشعار عربي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body"  maxlength="190" class="form-control" value="{{old('body')}}">
                                        </div>
                                    </div>
                    
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            الاشعار اجنبي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body_en"  maxlength="190" class="form-control" value="{{old('body_en')}}">
                                        </div>
                                    </div>
                    
                                    <div class="col-12 col-lg-6 p-2">
                                        <div class="col-12">
                                            الاشعار روسي
                                        </div>
                                        <div class="col-12 pt-3">
                                            <input type="text" name="body_ru" maxlength="190" class="form-control" value="{{old('body_ru')}}">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                        
                        <div class="col-12 p-3">
                            <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                        </div>
                        @endif
                        <div>
                            ____________________________________________________________________________
                            <br>
                            <br>
                        </div>
                       
                    </form>
 @endforeach
 <div class="col-12 col-lg-6 p-2">
    <div class="col-12">
        تفاصيل المستخدم
    </div>
    <div class="col-12 pt-3">
        <input type="text" name="countitems" value="{{$users->name}}" required maxlength="190" class="form-control" >
        <input type="text" name="countitems" value="{{$users->email}}" required maxlength="190" class="form-control" >
        <input type="text" name="countitems" value="{{$users->phone}}" required maxlength="190" class="form-control" >
    </div>
</div>
                </div>

            </div>

    </div>
</div>


@endsection
