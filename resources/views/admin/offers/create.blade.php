@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.offers.store',['offers_slide' => 'offers_slide'])}}" >
                @csrf
                <div class="col-12 col-lg-8 p-0 main-box">
                    <div class="col-12 px-0">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> {{$slide->slides_id}}
                            <input hidden="hidden" value="{{$slide->slides_id}}" name="offers_slide">
                        </div>
                        <div class="col-12 divider" style="min-height: 2px;"></div>
                    </div>
                    <div class="col-12 p-3 row">
                        <div class="col-12 p-2">
                            <div class="col-12">
                                صورة العرض الرئيسيه
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="main_offers_image" class="form-control" >
                            </div>
                        </div>

                        <div class="col-12 p-2">
                            <div class="col-12">
                                الصور
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="offers_image[]" class="form-control" accept="image/*" multiple>
                            </div>
                            <div class="col-12 pt-3">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اسم العرض
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="offers_name" required maxlength="190" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                سعر العرض
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="offers_price" required maxlength="190" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <select id="tags" name="items_id" data-placeholder="Select items" multiple data-multi-select>
                                @foreach ($items as $item)
                                    <option value="{{$item->items_id}}">{{$item->items_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <br>
                    <br><br><br><br><br>
                </div>

                <div class="col-12 p-3">
                    <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection

