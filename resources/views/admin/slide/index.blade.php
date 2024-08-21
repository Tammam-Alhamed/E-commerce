@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-articles"></span> الاعلانات
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<!--<div class="col-12 col-lg-4 p-2 text-lg-end">-->
				<!--	<a href="{{route('admin.slide.create')}}">-->
				<!--	<span class="btn btn-primary"><span class="fas fa-plus"></span> إضافة جديد</span>-->
				<!--	</a>-->
				<!--</div>-->
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
						<th>الصوره</th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@foreach($slide as $slide)
					<tr>
						<td>@if ($slide->slides_id == 1)
							 الخصومات
						@elseif($slide->slides_id == 2)
						عروض
							@else
							الجديده
						@endif
					    </td>
						<td> <img src="{{URL('Bazar/slides/'.$slide->slides_image)}}" alt="*image" style="width: 100px;"/>

						<td style="width: 270px;">

							@if(auth()->user()->has_access_to('update',$slide))
							<a href="{{route('admin.slide.edit',$slide->slides_id)}}">
								<span class="btn  btn-outline-success btn-sm font-1 mx-1">
									<span class="fas fa-wrench "></span> تحكم
								</span>
							</a>
							@endif
							<!--@if(auth()->user()->has_access_to('delete',$slide))-->
							<!--<form method="POST" action="{{route('admin.slide.destroy',$slide)}}" class="d-inline-block">@csrf @method("DELETE")-->
							<!--	<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">-->
							<!--		<span class="fas fa-trash "></span> حذف-->
							<!--	</button>-->
							<!--</form>-->
							<!--@endif-->
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
