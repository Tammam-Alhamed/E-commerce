<?php

use App\Http\Controllers\priceController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SiteMapController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ShopeController;
use App\Http\Controllers\RedirectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TrafficsController;
use App\Http\Controllers\bookController;
use App\Http\Controllers\autherController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PushNotificationController;
use Illuminate\Support\Facades\Auth;






Auth::routes();
//Route::get('/', function () {return view('front.index');})->name('home');
//Route::get('/test',[TestController::class,'index']);
Route::get('/',[HomeController::class,'index'])->name('home');

Route::prefix('admin')->middleware(['auth','CheckRole:ADMIN','ActiveAccount'])->name('admin.')->group(function () {
    Route::get('/',[AdminController::class,'index'])->name('index');


    Route::get('/profile',[AdminController::class,'upload_image']);
    Route::get('/profile',[AdminController::class,'upload_image']);
    
    Route::resource('contacts',ContactController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('users',UserController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('articles',ArticleController::class);
    Route::resource('book',bookController::class);
    Route::resource('auther',autherController::class);
    Route::resource('price',PriceController::class);
    Route::resource('categorie',CategorieController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('shope',shopeController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('item',ItemController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('order',OrdersController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('slide',SlideController::class)->middleware(['CheckRole:ADMIN|EDITOR']);
    Route::resource('redirections',RedirectionController::class)->middleware(['CheckRole:ADMIN|EDITOR']);

    Route::get('traffics',[TrafficsController::class,'index'])->name('traffics.index');
    Route::get('traffics/{traffic}/logs',[TrafficsController::class,'logs'])->name('traffics.logs');
    Route::get('error-reports',[TrafficsController::class,'error_reports'])->name('traffics.error-reports');
    Route::get('error-reports/{report}',[TrafficsController::class,'error_report'])->name('traffics.error-report');

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
Route::get('article/{article}',[FrontController::class,'article'])->name('article.show');
Route::get('blog',[FrontController::class,'blog'])->name('blog');
Route::post('contact',[FrontController::class,'contact_post'])->name('contact-post');


#############################################
Route::view('bootstrap','bootstrap');
#############################################

Route::put('update_order/{id}',[OrdersController::class,'update_order'])->name('update_order');

####################

Route::post('send',[PushNotificationController::class, 'bulksend'])->name('bulksend');
Route::get('all-notifications', [PushNotificationController::class, 'index']);
Route::get('get-notification-form', [PushNotificationController::class, 'create'])->name('create_noti');

######### FOR USERS ###########
Route::get('index/notificat/{id}',[UserController::class, 'index_notificat'])->name('index_notificat');
Route::post('send/for_users/{id}',[UserController::class, 'notificat'])->name('notificat_user');

######### FOR SEARCH ###########
Route::get('search',[searchController::class,'search'])->name('search');
Route::get('search/item',[searchController::class,'searchItem'])->name('searchItem');