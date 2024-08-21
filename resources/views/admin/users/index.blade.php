@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 main-box">
	 
		<div class="col-12 px-0">
			<div class="col-12 p-0 row">
				<div class="col-12 col-lg-4 py-3 px-3">
					<span class="fas fa-users"></span>	المستخدمين
				</div>
				<div class="col-12 col-lg-4 p-2">
				</div>
				<div class="col-12 col-lg-4 p-2 text-lg-end">
					<a href="{{route('admin.users.create')}}">
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
						<th>الاسم</th>
						<th>الهاتف</th>
						<th>الكود</th>
						<th>تم التحقق</th>
						<th>تحكم</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{$user->id}}</td>
						<td>{{$user->name}}</td>
						<td>{{$user->phone}}</td>
						<td>{{$user->users_verfiycode}}</td>
						@if($user->users_approve == 1) <td style="background-color: rgba(68, 197, 56, 0.527)"> @if ($user->users_approve == 1)
							نعم
						@endif </td>@endif
						@if($user->users_approve == 0) <td style="background-color: rgba(207, 68, 43, 0.527)"> @if ($user->users_approve == 0)
							لا
						@endif </td>@endif
						<td>
							@if(auth()->user()->has_access_to('update',$user))
							<a href="{{route('admin.users.edit',$user)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
							</a>
							@endif
							@if(auth()->user()->has_access_to('delete',$user))
							<form method="POST" action="{{route('admin.users.destroy',$user)}}" class="d-inline-block">@csrf @method("DELETE")
								<button class="btn  btn-outline-danger btn-sm font-1 mx-1" onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');if(result){}else{event.preventDefault()}">
									<span class="fas fa-trash "></span> حذف
								</button>
							</form>
							@endif
							<a href="{{route('index_notificat',$user->id)}}">
								<span class="btn  btn-primary btn-sm font-1 mx-1">
									<span class="fas fa-bell "></span> ارسال اشعار
								</span>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			</div>
		</div>
		<div class="col-12 p-3">
			{{$users->appends(request()->query())->render()}}
		</div>
	</div>
</div>
@endsection
