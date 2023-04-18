@extends('layouts.admin')
@section('content')
<div class="col-12 p-3">
	<div class="col-12 col-lg-12 p-0 ">
	 
		
		<form id="validate-form" class="row" enctype="multipart/form-data" method="POST" action="{{route('admin.auther.update',$auther)}}">
		@csrf
		@method("PUT")
		<div class="col-12 col-lg-8 p-0 main-box">
			<div class="col-12 px-0">
				<div class="col-12 px-3 py-3">
				 	<span class="fas fa-info-circle"></span> تعديل  المؤلف
				</div>
				<div class="col-12 divider" style="min-height: 2px;"></div>
			</div>
			<div class="col-12 p-3">
				
			
				<div class="col-12 p-2">
					<div class="col-12">
						الصورة الرئيسية
					</div>
					<div class="col-12 pt-3">
						<input type="file" name="name" class="form-control" accept="uploads/image/*">
					</div>
					<div class="col-12 pt-3">
						<img src="{{URL::asset($auther->name) }}" style="width:100px">
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