@extends('layouts.admin')
@section('content')
<style type="text/css">
	.settings-tab-opener{
		box-shadow: 0px 6px 12px #ebebeb;
    	border-radius:11px;
    	cursor: pointer;
    	width:80px;height: 45px;
	}
	.settings-tab-opener.active{
		box-shadow: 0px 6px 12px #c8e0ff!important;
		color: #fff;
		background: #2196f3;
	}
	.taber:not(.active){
		display: none;
	}
	
</style>
<div class="col-12 py-0 px-3 row">
	
	 <div class="col-12  p-0" style="background: #fff;min-height: 80vh">

	 	<div class="col-12 px-3 py-4">
	 		<h4 class="font-4">إعدادات الموقع</h4>
	 	</div>

	 	<div class="col-12 row" >
			<div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener active" data-opentab="general-tab">
				<span  class="fal fa-wrench me-2"></span>	عام
			</div>
			<div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener" data-opentab="appearance-tab">
				<span  class="fal fa-paint-roller me-2"></span>	مظهر
			</div>
			<div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener" data-opentab="links-tab">
				<span  class="fal fa-link me-2"></span>	روابط
			</div>
			<div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener" data-opentab="pages-tab">
				<span  class="fal fa-pager me-2"></span>	صفحات
			</div>
			<div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener" data-opentab="codes-tab">
				<span  class="fal fa-code me-2"></span>	أكواد
			</div>
			<div class="d-flex justify-content-center align-items-center p-0 m-2 settings-tab-opener" data-opentab="others-tab">
				<span  class="fal fa-cogs me-2"></span>	اخرى
			</div>
		</div>

	 	<form class="col-12 row " id="validate-form" method="POST" action="{{route('admin.settings.update')}}" enctype="multipart/form-data" >
	 	@csrf
	 	@method("PUT")
	 	
	 	<div class="col-12 col-lg-8 px-3 py-5">
	 		 
	 		<div class="col-12 row p-0 taber active" id="general-tab">
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				اسم الموقع
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="" name="website_name" class="form-control" value="{{$settings->website_name}}"  maxlength="190">
		 			</div> 
		 		</div>
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				العنوان
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<textarea name="address" class="form-control">{{$settings->address}}</textarea>
		 			</div> 
		 		</div>
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				عن الموقع
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<textarea name="website_bio" class="form-control">{{$settings->website_bio}}</textarea>
		 			</div> 
		 		</div>

		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				بريد التواصل
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="email" name="contact_email" class="form-control" value="{{$settings->contact_email}}" >
		 			</div> 
		 		</div>
		 		 

		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				لوجو الموقع
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="file" name="website_logo" class="form-control" >
		 				<div class="col-12 p-2">
		 					<img src="{{$settings->website_logo()}}" style="width:100px;max-height: 100px;">
		 				</div>
		 			</div> 
		 		</div>
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				اللوجو عريض
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="file" name="website_wide_logo" class="form-control" >
		 				<div class="col-12 p-2">
		 					<img src="{{$settings->website_wide_logo()}}" style="width:100px;max-height: 100px;">
		 				</div>
		 			</div> 
		 		</div>
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				الصورة المصغرة
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="file" name="website_icon" class="form-control" >
		 				<div class="col-12 p-2">
		 					<img src="{{$settings->website_icon()}}" style="width:100px;max-height: 100px;">
		 				</div>
		 			</div> 
		 		</div>
	 		</div>
	 		<div class="col-12 row p-0 taber" id="appearance-tab">
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				غلاف الموقع
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="file" name="website_cover" class="form-control" >
		 				<div class="col-12 p-2">
		 					<img src="{{$settings->website_cover()}}" style="width:100px;max-height: 100px;">
		 				</div>
		 			</div> 
		 		</div>

		 		
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				اللون الرئيسي
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="color" name="main_color"  value="{{$settings->main_color}}" maxlength="190">
		 			</div> 
		 		</div>
		 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
		 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
		 				اللون الفرعي
		 			</div>
		 			<div class="col-12 col-lg-9 px-2">
		 				<input type="color" name="hover_color"  value="{{$settings->hover_color}}" maxlength="190">
		 			</div> 
		 		</div>
		 		
		 	</div>
		 	<div class="col-12 row p-0 taber" id="links-tab">
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رقم الهاتف
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="" name="phone" class="form-control" value="{{$settings->phone}}" maxlength="190">
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رقم الهاتف 2
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="" name="phone2" class="form-control" value="{{$settings->phone2}}" maxlength="190">
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رقم واتس آب
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="" name="whatsapp_phone" class="form-control" value="{{$settings->whatsapp_phone}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط فيس بوك
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="facebook_link" class="form-control" value="{{$settings->facebook_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط تويتر
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="twitter_link" class="form-control" value="{{$settings->twitter_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط انستجرام
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="instagram_link" class="form-control" value="{{$settings->instagram_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط يوتيوب
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="youtube_link" class="form-control" value="{{$settings->youtube_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط تيلي جرام
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="telegram_link" class="form-control" value="{{$settings->telegram_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط واتس أب
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="whatsapp_link" class="form-control" value="{{$settings->whatsapp_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط تيك توك
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="tiktok_link" class="form-control" value="{{$settings->tiktok_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط نفذلي
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="nafezly_link" class="form-control" value="{{$settings->nafezly_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط لينكد ان
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="linkedin_link" class="form-control" value="{{$settings->linkedin_link}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط جيت هب
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="github_link" class="form-control" value="{{$settings->github_link}}" >
	 			</div> 
	 		</div>
	 		

	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<br>
	 			<hr>
	 		</div>

	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط مخصص 1
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="another_link1" class="form-control" value="{{$settings->another_link1}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط مخصص 2
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="another_link2" class="form-control" value="{{$settings->another_link2}}" >
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				رابط مخصص 3
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<input type="url" name="another_link3" class="form-control" value="{{$settings->another_link3}}" >
	 			</div> 
	 		</div>

	 	</div>
	 	<div class="col-12 row p-0 taber" id="pages-tab">
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				سياسة الخصوصية
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<textarea  name="privacy_page" class="form-control editor with-file-explorer">{{$settings->privacy_page}}</textarea>
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				شروط الإستخدام
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<textarea  name="terms_page" class="form-control editor with-file-explorer">{{$settings->terms_page}}</textarea>
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				من نحن
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<textarea  name="about_page" class="form-control editor with-file-explorer">{{$settings->about_page}}</textarea>
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				تواصل معنا
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<textarea  name="contact_page" class="form-control editor with-file-explorer">{{$settings->contact_page}}</textarea>
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<br>
	 			<hr>
	 		</div>
	 	</div>
	 	<div class="col-12 row p-0 taber" id="codes-tab">
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				كود الهيدر
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<textarea name="header_code" class="form-control" style="min-height: 200px;text-align: left;direction: ltr;">{{$settings->header_code}}</textarea>
	 			</div> 
	 		</div>
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				كود الفوتر
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<textarea name="footer_code" class="form-control" style="min-height: 200px;text-align: left;direction: ltr;">{{$settings->footer_code}}</textarea>
	 			</div> 
	 		</div> 
	 		<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				ملف robots
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<textarea name="robots_txt" class="form-control" style="min-height: 200px;text-align: left;direction: ltr;">{{$settings->robots_txt}}</textarea>
	 			</div> 
	 		</div>
	 	</div>
	 	<div class="col-12 row p-0 taber" id="others-tab">
	 	</div>

	 </div>
 
	 	<div class="col-12 col-lg-8 px-0 d-flex mb-3 row pb-3">
 		 	
 		 	<div class="col-12 px-0 d-flex mb-3 row pb-3">
	 			<div class="col-12 col-lg-3 px-2 text-lg-end pt-1 pb-3 pb-lg-0">
	 				
	 			</div>
	 			<div class="col-12 col-lg-9 px-2">
	 				<button class="btn pb-2 px-4" style="background: #ffa725;border-radius: 0px;color: #fff ">حفظ التغييرات</button>
	 			</div> 
	 		</div> 

 		</div>

	  	</form>
	 </div> 
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	$('.settings-tab-opener').on('click',function(){
		$('.settings-tab-opener').removeClass('active');
		$(this).addClass('active');
		var open_id = $(this).attr('data-opentab');
		$('.taber').removeClass('active');
		$('.taber#'+open_id).addClass('active');
	});
</script>
@endsection