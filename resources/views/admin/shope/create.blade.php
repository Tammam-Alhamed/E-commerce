@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.shope.store')}}" >
            @csrf
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
                            التصنيف
                        </div>
                        <div class="col-12 pt-3">
                        </div>
                    </div>
                    <div class="col-12">
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم (EN)
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="shopes_name" required maxlength="190" class="form-control" value="{{old('shopes_name')}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم (AR)
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="shopes_name_ar" required maxlength="190" class="form-control" value="{{old('shopes_name_ar')}}">
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            الاسم (RU)
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="shopes_name_ru" required maxlength="190" class="form-control" value="{{old('shopes_name_ru')}}">
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            الصورة 
                        </div>
                        <div class="col-12 pt-3">
                            <input type="file" name="shopes_image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12 pt-3">
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
