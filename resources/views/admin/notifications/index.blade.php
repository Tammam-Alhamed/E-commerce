@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-articles"></span> الاشعارات
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
						<th> الاسم (EN)</th>
						<th> الاسم (AR)</th>
						<th> الاسم (RU)</th>
					</tr>
				</thead>
				<tbody>
					@foreach($notifications as $push_notification)
					<tr>
						<td>{{$push_notification->notification_id}}</td>
						<td>{{$push_notification->notification_body_en}}</td>
						<td>{{$push_notification->notification_body}}</td>
						<td>{{$push_notification->notification_body_ru}}</td>
						<td style="width: 270px;">

							@if(auth()->user()->has_access_to('delete',$push_notification))
							<form method="POST" action="{{route('destroy_noti',$push_notification->notification_id)}}" class="d-inline-block">@csrf @method("DELETE")
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
