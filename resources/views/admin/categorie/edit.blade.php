@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.categorie.update',$categorie)}}" >
            @csrf
            @method("PUT")
            <div class="col-12 col-lg-8 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fas fa-info-circle"></span> إضافة جديد
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 p-3 row">
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            المتجر
                        </div>
                        <div class="col-12 pt-3">
                            <select class="form-control" name="categories_shope" required>
                                <option value selected disabled hidden>إختر المتجر</option>
                                @foreach($shope as $shope)
                                <option value="{{$shope->shopes_id}}" @if($categorie->categories_shope == $shope->shopes_id) selected @endif>{{$shope->shopes_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم (EN)
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="categories_name"  maxlength="190" class="form-control" value="{{$categorie->categories_name}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم (AR)
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="categories_name_ar"  maxlength="190" class="form-control" value="{{$categorie->categories_name_ar}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم (RU)
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="categories_name_ru"  maxlength="190" class="form-control" value="{{$categorie->categories_name_ru}}">
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            الصورة 
                        </div>
                        <div class="col-12 pt-3">
                            <input type="file" name="categories_image" class="form-control" accept="ecommercecourse-PHP--177/upload/categories">
                        </div>
                    </div>
                    
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الصوره
                            </div>
                            <div>
                                 <img src="{{URL('Bazar/categories/'.$categorie->categories_image)}}" alt="*image" style="width: 450px;"/>
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
