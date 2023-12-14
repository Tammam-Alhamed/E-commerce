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
                                <option value="{{$categorie->categories_id}}" @if($item->items_cat == $categorie->categories_id) selected @endif>{{$categorie->categories_name}}</option>
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
                                    <option @if($item->items_delay == "0") selected @endif  @if($item->items_delay == "0") selected @endif value="0" > لا</option>
                                    <option @if($item->items_delay == "1") selected @endif @if($item->items_delay == "1") selected @endif value="1" >نعم</option>
                                </select>
                            </div>
    
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                جديد
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_new" required>
                                    <option @if($item->items_new == "0") selected @endif  value="0" > لا</option>
                                    <option @if($item->items_new == "1") selected @endif value="1" >نعم</option>
                                </select>
                            </div>
    
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                عرض
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_offer" required>
                                    <option @if($item->items_offer == "0") selected @endif  value="0" > لا</option>
                                    <option @if($item->items_offer == "1") selected @endif value="1" >نعم</option>
                                </select>
                            </div>
    
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                نفذت الكميه
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_sold" required>
                                    <option @if($item->items_sold == "0") selected @endif value="0" > لا</option>
                                    <option @if($item->items_sold == "1") selected @endif value="1" >نعم</option>
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
                                رقم الترتيب
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_filter" value="{{$item->items_filter}}"  required maxlength="190" class="form-control" >
                            </div>
                        </div>
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
                            <input  type="file" class="form-control" name="items_image_main" placeholder="address">
                            <label>{{$item->items_image_main}}</label>
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
                    <div></div>
                    @php
                    $color = DB::table('colors')->where('colors_items' , $item->items_id)->get();
                @endphp
            <div class="col-12 col-lg-6 p-2">
                     <div class="col-12">
                         الالوان
                    </div>
                @foreach ($color as $colors)


                <div class="col-12 pt-3">
                    <input type="text" name="colors[{{$loop->index}}][colors_name]"  value="{{$colors->colors_name}} "  maxlength="190" class="form-control" >
                    
                    <input type="hidden" name="colors[{{$loop->index}}][colors_id]" , value="{{$colors->colors_id}}">
                    
                </div>
                       
                @endforeach
            </div> 

            @php
            $size = DB::table('sizes')->where('sizes_items' , $item->items_id)->get();
        @endphp



    <div class="col-12 col-lg-6 p-2">
        <div class="col-12">
            المقاسات
       </div>
        @foreach ($size as $sizes)
        
            <div class="col-12 pt-3">
                <input type="text" name="sizes[{{$loop->index}}][sizes_name]"  value="{{$sizes->sizes_name}} "  maxlength="190" class="form-control" >
                
                <input type="hidden" name="sizes[{{$loop->index}}][sizes_id]" , value="{{$sizes->sizes_id}}">
                
            </div>
               
            @endforeach 
    </div> 
                         @foreach ($images as $image )
        
    
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الصوره
                            </div>
                            <div>
                                 <img src="{{URL('Bazar/items/'.$image->images_name)}}" alt="*image" style="width: 450px; height: 300px;" />
                            </div>
                        </div>

                        @endforeach
                </div>
            </div>
            <div class="col-12 p-3">
                <button class="btn btn-success" id="submitEvaluation">حفظ</button>
            </div>
        </form>
    </div>
</div>
@endsection
