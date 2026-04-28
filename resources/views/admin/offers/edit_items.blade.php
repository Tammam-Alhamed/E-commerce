@extends('layouts.admin')
@section('content')
    <div class="col-12 p-3">
        <div class="col-12 col-lg-12 p-0 ">
            <form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.offers.update',$offers)}}" >
                @csrf
                @method("PUT")
                <div class="col-12 col-lg-8 p-0 main-box">
                    <div class="col-12 px-0">
                        <div class="col-12 px-3 py-3">
                            <span class="fas fa-info-circle"></span> تعديل العرض
                            <input hidden="hidden" name="offers_slide" value="{{$offers->offers_slide}}">
                        </div>
                        <div class="col-12 divider" style="min-height: 2px;"></div>
                    </div>
                    <div class="col-12 p-3 row">

                        <div class="col-12">
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                اسم العرض
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="offers_name"  maxlength="190" class="form-control" value="{{$offers->offers_name}}">
                            </div>
                        </div>

                        <div class="col-12 col-lg-6 p-2">
                            <div class="col-12">
                                سعر العرض
                            </div>
                            <div class="col-12 pt-3">
                                <input type="text" name="offers_price"  maxlength="190" class="form-control" value="{{$offers->offers_price}}">
                            </div>
                        </div>
                        <div class="col-12 p-2">
                            <div class="col-12">
                                صورة العرض الرئيسيه
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="main_offers_image" class="form-control"  value="{{$offers->offers_image}}">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 p-2">
                            <div>
                                <img src="{{URL('Bazar/offers/'.$offers->offers_image)}}" alt="*image" style="width: 150px; height: 100px;" />
                            </div>
                        </div>
                        <div class="col-12 p-2">
                            <div class="col-12">
                                صور العرض
                            </div>
                            <div class="col-12 pt-3">
                                <input type="file" name="offers_image[]" class="form-control"  value="{{$offers->offers_image}}" multiple>
                            </div>
                        </div>



                        <div class="col-12 p-2">
                            <div class="col-12">
                                اختيار المنتجات
                            </div>
                            <div class="col-12 pt-3">
                                <select id="tags" name="items_id[]" data-placeholder="اختر المنتجات" multiple data-multi-select>
                                    @foreach ($allItems as $item)
                                        <option @if($offers->items->contains($item->items_id)) selected @endif value="{{$item->items_id}}">{{$item->items_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 p-2">
                            <div class="col-12">
                                <h5>كميات المنتجات</h5>
                            </div>
                        </div>

                        @foreach($offers->items as $item)
                            <div class="col-12 col-lg-6 p-2">
                                <div class="col-12">
                                    {{$item->items_name}}
                                </div>
                                <div class="col-12 pt-3">
                                    <input type="number" name="item_quantity[{{$item->items_id}}]" min="1" class="form-control"
                                           value="{{$itemOffers->where('items_id', $item->items_id)->first()->qua ?? 1}}"
                                           placeholder="الكمية">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-lg-6 p-2">
                    <div class="col-12">
                        صور العرض الحالية
                    </div>
                    @foreach ($images as $image )


                        <div class="col-12 col-lg-6 p-2">
                            <div>
                                <img src="{{URL('Bazar/offers/'.$image->images_name)}}" alt="*image" style="width: 450px; height: 300px;" />
                            </div>
                        </div>

                    @endforeach
                </div>
                <div class="col-12 p-3">
                    <button class="btn btn-success" id="submitEvaluation">حفظ</button>
                </div>
            </form>
        </div>
    </div>
@endsection
