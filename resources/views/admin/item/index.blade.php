@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-articles"></span> المنتجات
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.item.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
					</a>
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

		<div class="col-12 py-2 px-2 row">
			<div class="col-12 col-lg-4 p-2">
				<form method="GET" action="{{route('searchItem')}}">
					<input type="text" name="name" class="form-control" placeholder=" بحث من خلال الاسم و القسم ... ">
				</form>
			</div>
		</div>

		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="min-width:1100px;">
				
			
			<table class="table table-bordered  table-hover">
				{{ $items->links() }}
				<thead>
					<tr>
						<th>#</th>
						<th>القسم</th>
						<th> الاسم (AR) </th>
						<th>الاسم (EN)</th>
						<th>الاسم (RU)</th>
						{{-- <th>الكميه</th> --}}
						<th>التأخير</th>
						<th>السعر</th>
                        <th>الخصم</th>

						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@foreach($items as $item)
					<tr>
						<td>{{$item->items_id}}</td>
						<td>{{$item->categorie->categories_name}}</td>
						<td>{{$item->items_name_ar}}</td>
						<td>{{$item->items_name}}</td>
						<td>{{$item->items_name_ru}}</td>
						{{-- <td>{{$item->items_count}}</td> --}}
						<td>@if($item->items_delay == "0") لا @endif
							@if($item->items_delay == "1") نعم @endif
						</td>
                        <td>{{$item->items_price_d}}</td>
                        <td>{{$item->items_discount}}%</td>

						
						<td style="width: 270px;">

							@if(auth()->user()->has_access_to('update',$item))
							<a href="{{route('admin.item.edit',$item)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$item))
							<form method="POST" action="{{route('admin.item.destroy',$item)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> حذف
								</button>
							</form>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $items->links() }}
			</div>
		</div>
		<div class="col-12 p-3">
			
		</div>
	</div>
</div>
@endsection
