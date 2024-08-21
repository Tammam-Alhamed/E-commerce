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
				
					<input type="text" name="id_uni" class="form-control" placeholder="بحث ... ">

			</div>
	
		</div>
		<form action="{{route('search' )}}" method="GET">
		<div  class="col-12 py-2 px-2 row"> 

				<div class="col-12 col-lg-4 p-2">
					<select class="form-control" name="state" >
						<option value selected disabled hidden> الفرز حسب الحاله</option>

						<option  value="0" >في انتظار الموافقه</option>
						<option  value="1" >يتم تحضير الطلب</option>
						<option  value="2">جاهز للاستلام من قبل مندوب التوصيل</option>
						<option  value="3" >تم انجاز الطلب</option>

					</select>
				</div>
				<div class="col-12 p-3">
					<button class="btn btn-success" id="submitEvaluation">فرز</button>
				</div>
			
		</div>
	</form>

		<div class="col-12 p-3" style="overflow:auto">
			<div class="col-12 p-0" style="min-width:1100px;">
				
			
			<table class="table table-bordered  table-hover">
				<thead>
					<tr>
						<th></th>
						<th>#</th>
						<th> نوع التوصيل </th>
						<th> سعر الطلب </th>
                        <th> حاله الطلب </th>
                        <th>  تاريخ الطلب </th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@foreach($order as $order)
					<tr>
						@if($order->orders_read == 0) <td style="background-color: rgb(148, 0, 0)"></td>@endif
						@if($order->orders_read == 1) <td></td>@endif
						<td>{{$order->orders_id}}</td>
						<td>
                           @if($order->orders_type == 0)
                           الدفع باليد
                           @else
                           الدفع عند التوصيل
                           @endif
                        </td>
						<td>{{$order->orders_totalprice_d}}</td>

						    @if($order->orders_status == 0) <td style="background-color: rgba(218, 165, 32, 0.623)"> @if($order->orders_status == 0)
								في انتظار الموافقه 
                            @endif </td>@endif
							@if($order->orders_status == 1) <td style="background-color: rgba(31, 86, 206, 0.459)"> @if ($order->orders_status == 1)
								يتم تحضير الطلب
                            @endif </td>@endif
							@if($order->orders_status == 2) <td style="background-color: rgba(62, 65, 63, 0.774)"> @if ($order->orders_status == 2)
								طلبك جاهز للاستلام-ارسل اليك
                            @endif </td>@endif
							@if($order->orders_status == 3) <td style="background-color: rgba(142, 45, 180, 0.692)"> @if ($order->orders_status == 3)
                            شكرا للتسوق في بازار
                            @endif </td>@endif
							@if($order->orders_status == 4) <td style="background-color: rgba(68, 197, 56, 0.527)"> @if ($order->orders_status == 4)
								أرشيف
                            @endif </td>@endif


                        <td>{{$order->orders_datetime}}</td>
						
						<td style="width: 270px;">

							@if(auth()->user()->has_access_to('update',$order))
							<a href="{{route('admin.order.edit',$order->orders_id)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$order))
							<form method="POST" action="{{route('admin.order.destroy',$order->orders_id)}}" class="d-inline-block">@csrf @method("DELETE")
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
