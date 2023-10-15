@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.item.update' , $item)}}">
            @csrf
            @method('PUT')
            <div class="col-12 col-lg-8 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fas fa-info-circle"></span> اضافه منتج
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 p-3 row">

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            التصنيف
                        </div>
                        <div class="col-12 pt-3">
                            <select class="form-control" name="items_cat" required>
                                @foreach($categorie as $categorie)
                                <option selected value="{{$categorie->categories_id}}">{{$categorie->categories_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
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


                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم (AR)
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="items_name_ar" value="{{$item->items_name_ar}}" required maxlength="190" class="form-control" >
                        </div>
                    </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الاسم (EN)
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_name" value="{{$item->items_name}}" required maxlength="190" class="form-control" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الاسم (RU)
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_name_ru" value="{{$item->items_name_ru}}" required maxlength="190" class="form-control" >
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الخصم
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_discount" value="{{$item->items_discount}}" required maxlength="190" class="form-control" >
                            </div>
                        </div>
                        {{-- <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الحاله
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_active" required>
                                    <option selected  value="1" > فعاله</option>
                                    <option  value="2" >غير فعاله</option>
    
                                </select>
                            </div>
    
                        </div> --}}
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                التأخير
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_delay" required>
                                    <option @if($item->items_delay == "0") selected @endif  value="0" > لا</option>
                                    <option @if($item->items_delay == "1") selected @endif value="1" >نعم</option>
                                </select>
                            </div>
    
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                السعر
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_price" value="{{$item->items_price}}" required maxlength="190" class="form-control" >
                            </div>
                        </div>
                        {{-- <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الكمية
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_count" value="{{$item->items_count}}" required maxlength="190" class="form-control" >
                            </div>
                        </div> --}}
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                السعر بالدولار
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_price_d" value="{{$item->items_price_d}}" required maxlength="190" class="form-control" >
                            </div>
                        </div>

                    <div class="col-12 p-2">
                        <div class="col-12">
                            الصورة الرئيسية
                        </div>
                        <div class="col-12 pt-3" >
                            <input type="file" name="items_image" value="{{$item->items_image}}" class="form-control" accept="{{$item->items_image}}">
                            <label>{{$item->items_image}}</label>
                        </div>
                        
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الوصف (AR) 
                        </div>
                        <div class="col-12 pt-3">
                            <textarea name="items_desc_ar"  class="form-control" style="min-height:150px">{{$item->items_desc_ar}}</textarea>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الوصف (EN) 
                        </div>
                        <div class="col-12 pt-3">
                            <textarea name="items_desc"  class="form-control" style="min-height:150px">{{$item->items_desc}}</textarea>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الوصف (RU) 
                        </div>
                        <div class="col-12 pt-3">
                            <textarea name="items_desc_ru"  class="form-control" style="min-height:150px">{{$item->items_desc_ru}}</textarea>
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
