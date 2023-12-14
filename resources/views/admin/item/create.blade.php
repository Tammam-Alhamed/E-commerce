@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST"
                action="{{ route('admin.item.store') }}">
                @csrf
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
                                القسم
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_cat" required>
                                    @foreach ($categorie as $categorie)
                                        <option selected value="{{ $categorie->categories_id }}">
                                            {{ $categorie->categories_name }}</option>
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
                            @foreach ($auther as $auther)
                            <option value="{{$auther->id}}" @if ($tran->auther_id == $auther->id) selected @endif>{{$auther->name}}</option>
                            @endforeach
                        </select>
                    </div> --}}


                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الاسم (AR)
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_name_ar" required maxlength="190" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الاسم (EN)
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_name" required maxlength="190" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الاسم (RU)
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_name_ru" required maxlength="190" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الخصم
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_discount" required maxlength="190" class="form-control">
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
                                    <option selected value="0"> لا</option>
                                    <option value="1">نعم</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                جديد
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_new" required>
                                    <option selected value="0"> لا</option>
                                    <option value="1">نعم</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                عرض
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_offer" required>
                                    <option selected value="0"> لا</option>
                                    <option value="1">نعم</option>
                                </select>
                            </div>

                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                نفذت الكميه
                            </div>
                            <div class="col-12 pt-3">
                                <select class="form-control" name="items_sold" required>
                                    <option selected value="0"> لا</option>
                                    <option value="1">نعم</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                السعر
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_price" required maxlength="190" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                رقم الترتيب
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_filter" required maxlength="190" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                السعر بالدولار
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="items_price_d" required maxlength="190" class="form-control">
                            </div>
                        </div>

                        <div class="col-12 p-2">
                            <div class="col-12">
                                الصورة الرئيسية
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" class="form-control" name="items_image_main" placeholder="address">
                            </div>
                        </div>

                        <div class="col-12 p-2">
                            <div class="col-12">
                                الصور الداخليه
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" class="form-control" name="items_image[]" placeholder="address"
                                    multiple>

                            </div>

                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الوصف (AR)
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="items_desc_ar" class="form-control" style="min-height:150px"></textarea>
                            </div>
                        </div>


                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الوصف (EN)
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="items_desc" class="form-control" style="min-height:150px"></textarea>
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الوصف (RU)
                            </div>
                            <div class="col-12 pt-3">
                                <textarea name="items_desc_ru" class="form-control" style="min-height:150px"></textarea>
                            </div>
                        </div>
                        <div></div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اضافة الوان
                            </div>

                            <div class='item'>
                                
                                <button type="button" id="add_color">Add +</button>
                            </div>
                            <div id="items_color">
                            </div>

                            <script>
                                window.addEventListener("DOMContentLoaded", () => {
                                    let n = 0;
                                    let template_color =
                                        `<div class='item'><input type="text" name="colors_name[]" placeholder="Enter Something" /><button class="remove">X</button></div>`;
                                    let add_color = document.getElementById("add_color");
                                    let items_color = document.getElementById("items_color");

                                    add_color.addEventListener("click", () => {
                                        if (n >= 10) {
                                            alert("Maximum Limit Reached");
                                        } else {
                                            ++n;
                                            items_color.innerHTML += template_color;
                                        }
                                    });

                                    document.body.addEventListener("click", (e) => {
                                        const target = e.target;
                                        if (target.classList.contains("remove")) {
                                            target.parentNode.remove();
                                        }
                                    });
                                })
                            </script>

                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اضافة المقاسات
                            </div>

                            <div class='item'>
                                
                                <button type="button" id="add">Add +</button>
                            </div>
                            <div id="items">
                            </div>

                            <script>
                                window.addEventListener("DOMContentLoaded", () => {
                                    let i = 0;
                                    let template =
                                        `<div class='item'><input type="text" name="sizes_name[]" placeholder="Enter Something" /><button class="remove">X</button></div>`;
                                    let add = document.getElementById("add");
                                    let items = document.getElementById("items");

                                    add.addEventListener("click", () => {
                                        if (i >= 10) {
                                            alert("Maximum Limit Reached");
                                        } else {
                                            ++i;
                                            items.innerHTML += template;
                                        }
                                    });

                                    document.body.addEventListener("click", (e) => {
                                        const target = e.target;
                                        if (target.classList.contains("remove")) {
                                            target.parentNode.remove();
                                        }
                                    });
                                })
                            </script>
                            
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
