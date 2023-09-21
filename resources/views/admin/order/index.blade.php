@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-articles"></span> الكتب
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.order.create')}}">
					<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>
					</a>
				</div>
			</div>
			<div class="col-12 divider" style="min-height: 2px;"></div>
		</div>

		<div class="col-12 py-2 px-2 row">
			<div class="col-12 col-lg-4 p-2">
				<form method="GET">
					<input type="text" name="q" class="form-control" placeholder="بحث ... ">
				</form>
			</div>
		</div>
		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="min-width:1100px;">
				
			
			<table class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th> نوع التوصيل </th>
						<th> سعر الطلب </th>
                        <th> طريقه الدفع </th>
                        <th>  الحي السكني </th>
                        <th>  اسم الشارع </th>
                        <th>  تاريخ الطلب </th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@foreach($order as $order)
					<tr>
						<td></td>
						<td>
                           @if($order->orders_type == 0)
                           الدفع باليد
                           @else
                           الدفع عند التوصيل
                           @endif
                        </td>
						<td>{{$order->orders_price}}</td>
                        <td>
                            @if($order->orders_status == 0)
                            في انتظار الموافقه
                            @endif
                            @if ($order->orders_status == 1)
                            يتم تحضير الطلب 
                            @endif
                            @if ($order->orders_status == 2)
                            جاهز للاستلام من قبل مندوب التوصيل
                            @endif
                            @if ($order->orders_status == 3)
                            علي الطريق
                            @endif
                        </td>
                        <td>{{$order->address_city}}</td>
                        <td>{{$order->address_street}}</td>
                        <td>{{$order->orders_datetime}}</td>
						
						<td style="width: 270px;">

							@if(auth()->user()->has_access_to('update',$order))
							<a href="{{route('admin.order.edit',$order->orders_usersid)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$order))
							<form method="POST" action="" class="d-inline-block">@csrf @method("DELETE")
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
