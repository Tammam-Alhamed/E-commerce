@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.slide.update',$slide)}}" >
        @csrf
        @method("PUT")
        <div class="col-12 px-0">
            <div class="col-12 p-0 row">
                <div class="col-12 col-lg-4 py-3 px-3">
                    <span class="fas fa-articles"></span> الاعلانات
                </div>
                <div class="col-12 col-lg-4 p-2">
                </div>
                <div class="col-12 col-lg-4 p-2 text-lg-end">
                    <a href="{{route('admin.offers.index',$slide->slides_id)}}">
                        <span class="btn btn-primary">تفاصيل العرض</span>
                    </a>
                </div>
            </div>
            <div class="col-12 divider" style="min-height: 2px;"></div>
        </div>
        <div class="col-12 p-3 row">

            <div class="col-4 p-2">
                <div class="col-12">
                    الصورة
                </div>
                <div class="col-12 pt-3">
                    <input type="file" name="slide_image" class="form-control"  value="{{$slide->slides_image}}">
                </div>
            </div>
                <div class="col-4 p-2">
                    <div class="col-12">
                    سعر العرض
                </div>
                <div class="col-12 pt-3">
                    <input type="text" name="slides_name"  maxlength="190" class="form-control" value="{{$slide->slides_name}}">
                </div>
            </div>
            <div class="col-12 col-lg-6 p-2">
                <div class="col-12">
                    الصوره
                </div>
                <div>
                    <img src="{{URL('Bazar/slides/'.$slide->slides_image)}}" alt="*image" style="width: 250px;"/>
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
