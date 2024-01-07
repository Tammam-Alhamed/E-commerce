@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.price.update',$price)}}" >
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

                    <div class="col-12 p-2">
                        <div class="col-12">
                            الصورة 
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="price" value="{{$price->price}}" required maxlength="190" class="form-control" >
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