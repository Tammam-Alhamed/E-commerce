@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.coupon.update' , $coupons)}}" >
            @csrf
            @method('PUT')
            <div class="col-12 col-lg-8 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fas fa-info-circle"></span> إضافة جديد
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 p-3 row">
                    <div class="col-12">
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="coupon_name" required maxlength="190" class="form-control" value="{{$coupons->coupon_name}}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الخصم
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="coupon_discount" required maxlength="190" class="form-control" value="{{$coupons->coupon_discount}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            عدد المرات
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="coupon_count" required maxlength="190" class="form-control" value="{{$coupons->coupon_count}}">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            تاريخ الانتهاء
                        </div>
                        <div class="col-12 pt-3">
                            
                                <div class="row form-group">
                                    
                                    <div class="col-sm-12">
                                        <div class="input-group date" id="datepicker">
                                            <input type="text" class="form-control" name="coupon_expiredate" value="{{$coupons->coupon_expiredate}}">
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white d-block">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
        </form>
    </div>
</div>
@endsection
