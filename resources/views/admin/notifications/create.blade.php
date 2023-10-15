{{-- <form action="{{route('bulksend')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Title" name="title">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Message</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Notification Description" name="body" required>
    </div>
    <button type="submit" class="btn btn-primary">Send Notification</button>
</form> --}}


@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('bulksend')}}" >
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
                            العنوان
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="title" required maxlength="190" class="form-control" value="{{old('title')}}">
                        </div>
                    </div>
                </div>
                <div class="col-12 p-3 row">
                <div class="col-12 col-lg-6 p-2">
                    <div class="col-12">
                        المضمون عربي
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="body" required maxlength="190" class="form-control" value="{{old('body')}}">
                    </div>
                </div>

                <div class="col-12 col-lg-6 p-2">
                    <div class="col-12">
                        المضمون اجنبي
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="body_en" required maxlength="190" class="form-control" value="{{old('body_en')}}">
                    </div>
                </div>

                <div class="col-12 col-lg-6 p-2">
                    <div class="col-12">
                        المضمون روسي
                    </div>
                    <div class="col-12 pt-3">
                        <input type="text" name="body_ru" required maxlength="190" class="form-control" value="{{old('body_ru')}}">
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
