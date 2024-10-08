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
					<a href="{{route('admin.coupon.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
					</a>
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

		<div class="col-12 py-2 px-2 row">
			<div class="col-12 col-lg-4 p-2">
				<form method="GET" action="#">
					<input type="text" name="name" class="form-control" placeholder=" بحث ... ">
				</form>
			</div>
		</div>

		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="min-width:1100px;">
				
			
			<table class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>الاسم</th>
						<th> الخصم </th>
						<th> عدد المرات </th>
						<th>وقت الانتهاء</th>
					</tr>
				</thead>
				<tbody>
					@foreach($coupons as $coupon)
					<tr>
						<td>{{$coupon->coupon_id}}</td>
						<td>{{$coupon->coupon_name}}</td>
						<td>{{$coupon->coupon_discount}}%</td>
						<td>{{$coupon->coupon_count}}</td>
						<td>{{$coupon->coupon_expiredate}}</td>
						<td style="width: 270px;">

							@if(auth()->user()->has_access_to('update',$coupon))
							<a href="{{route('admin.coupon.edit',$coupon->coupon_id)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$coupon))
							<form method="POST" action="{{route('admin.coupon.destroy',$coupon)}}" class="d-inline-block">@csrf @method("DELETE")
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
			</div>
		</div>
		<div class="col-12 p-3">
			
		</div>
	</div>
</div>
@endsection
