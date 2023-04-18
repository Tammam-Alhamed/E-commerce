@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
    <div class="col-12 col-lg-12 p-0 ">
        <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.book.update',$book)}}">
            @csrf
            @method("PUT")
            <div class="col-12 col-lg-8 p-0 main-box">
                <div class="col-12 px-0">
                    <div class="col-12 px-3 py-3">
                        <span class="fas fa-info-circle"></span> تعديل مقال
                    </div>
                    <div class="col-12 divider" style="min-height: 2px;"></div>
                </div>
                <div class="col-12 p-3 row">

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            التصنيف
                        </div>
                        <div class="col-12 pt-3">
                            <select class="form-control" name="genre_id" required>
                                <option value selected disabled hidden>إختر التصنيف</option>
                                @foreach($genres as $genres)
                                <option value="{{$genres->id}}" @if(old('genre_id')==$genres->id) selected @endif>{{$genres->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                    </div>

                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                            العنوان
                        </div>
                        <div class="col-12 pt-3">
                            <input type="text" name="title" required maxlength="190" class="form-control" value="{{$book->title}}">
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                السعر
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="price" required maxlength="190" class="form-control" value="{{$book->price}}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الخصم
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="price_after" required maxlength="190" class="form-control" value="{{$book->price_after}}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                الكمية
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="quantity" required maxlength="190" class="form-control" value="{{$book->quantity}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-2">
                        <div class="col-12">
                            الصورة الرئيسية
                        </div>
                        <div class="col-12 pt-3">
                            <input type="file" name="cover" class="form-control" accept="uploads/image/*">
                        </div>
                        <div class="col-12 pt-3">
                            <img src="{{URL::asset($book->cover) }}" style="width:100px">
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 p-2">
                        <div class="col-12">
                             الوصف 
                        </div>
                        <div class="col-12 pt-3">
                            <textarea name="content" class="form-control" style="min-height:150px">{{$book->content}}</textarea>
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
