<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\OffersController;
use App\Models\User;
use App\Models\orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\priceController;
use App\Http\Controllers\ShopeController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\autherController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\PushNotificationController;
use App\Http\Controllers\TagsController;





Auth::routes();
//Route::get('/', function () {return view('front.index');})->name('home');
//Route::get('/test',[TestController::class,'index']);
Route::get('/',[HomeController::class,'index'])->name('home');

Route::prefix('admin')->middleware(['auth','CheckRole:ADMIN','ActiveAccount'])->name('admin.')->group(function () {
    Route::get('/',[AdminController::class,'index'])->name('index');


    Route::get('/profile',[AdminController::class,'upload_image']);
    Route::get('/profile',[AdminController::class,'upload_image']);

    Route::resource('users',UserController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('auther',autherController::class);
    Route::resource('price',PriceController::class);
    Route::resource('categorie',CategorieController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('shope',shopeController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('item',ItemController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('order',OrdersController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('slide',SlideController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('coupon',CouponController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('tags',tagsController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('offers',OffersController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    //offersRoute{
    Route::get('offersEditItems/{id}',[OffersController::class,'editItems'])->name('offers.edit-items');
    Route::get('index/{id}',[OffersController::class,'index'])->name('offers.index');
    Route::get('create/{id}',[OffersController::class,'create'])->name('offers.create');

    //}
    Route::prefix('upload')->name('upload.')->group(function(){
        Route::post('/image',[HelperController::class,'upload_image'])->name('image');
        Route::post('/file',[HelperController::class,'upload_file'])->name('file');
        Route::post('/remove-file',[HelperController::class,'remove_files'])->name('remove-file');
    });
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/',[ProfileController::class,'index'])->name('index');
        Route::get('/edit',[ProfileController::class,'edit'])->name('edit');
        Route::put('/update',[ProfileController::class,'update'])->name('update');
        Route::put('/update-password',[ProfileController::class,'update_password'])->name('update-password');
        Route::put('/update-email',[ProfileController::class,'update_email'])->name('update-email');
    });
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/',[PushNotificationController::class,'index'])->name('index');
        Route::get('/ajax',[PushNotificationController::class,'notifications_ajax'])->name('ajax');
        Route::post('/see',[PushNotificationController::class,'notifications_see'])->name('see');
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/',[SettingController::class,'index'])->name('index');
        Route::put('/update',[SettingController::class,'update'])->name('update');
    });
});


Route::get('blocked',[HelperController::class,'blocked_user'])->name('blocked');
Route::get('robots.txt',[HelperController::class,'robots']);
Route::get('manifest.json',[HelperController::class,'manifest']);
Route::get('sitemap.xml',[SiteMapController::class,'sitemap']);
Route::get('sitemaps/links','SiteMapController@custom_links');
Route::get('sitemaps/{name}/{page}/sitemap.xml',[SiteMapController::class,'viewer']);


//pages
Route::view('about','front.pages.about');
Route::view('privacy','front.pages.privacy');
Route::view('terms','front.pages.terms');
Route::view('contact','front.pages.contact');




Route::put('update_order/{id}',[OrdersController::class,'update_order'])->name('update_order');

####################

Route::post('send',[PushNotificationController::class, 'bulksend'])->name('bulksend');
Route::get('all-notifications', [PushNotificationController::class, 'index']);
Route::get('get-notification-form', [PushNotificationController::class, 'create'])->name('create_noti');
Route::DELETE('delete-notification/{id}', [PushNotificationController::class, 'destroy'])->name('destroy_noti');

######### FOR USERS ###########
Route::get('index/notificat/{id}',[UserController::class, 'index_notificat'])->name('index_notificat');
Route::post('send/for_users/{id}',[UserController::class, 'notificat'])->name('notificat_user');

######### FOR SEARCH ###########
Route::get('search',[searchController::class,'search'])->name('search');
Route::get('search/item',[searchController::class,'searchItem'])->name('searchItem');
