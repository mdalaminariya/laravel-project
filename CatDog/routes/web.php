<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CatBlogController;
use App\Http\Controllers\Frontend\GuestAuthentication;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Auth::routes(['register' => false]);


// frontend

Route::get('/',[FrontendHomeController::class,'index'])->name('frontend');
Route::get('/category/{slug}',[CatBlogController::class,'show'])->name('frontend.cat.blog');
Route::get('/blogs',[FrontendBlogController::class,'index'])->name('frontend.blogs');
Route::get('/blog/single/{slug}',[FrontendBlogController::class,'single'])->name('frontend.blog.single');
Route::post('/blog/comment/{id}',[FrontendBlogController::class,'comment'])->name('frontend.blog.comment');

Route::get('guest/login',[GuestAuthentication::class,'login'])->name('guest.login');
Route::post('guest/login',[GuestAuthentication::class,'login_post'])->name('guest.login');
Route::get('guest/register',[GuestAuthentication::class,'register'])->name('guest.register');
Route::post('guest/register',[GuestAuthentication::class,'register_post'])->name('guest.register');

Route::get('/role/request',[RequestController::class,'index'])->name('request.show');
Route::get('/role/request/accept/{id}',[RequestController::class,'accept'])->name('request.accept');
Route::get('/role/request/cancel/{id}',[RequestController::class,'cancel'])->name('request.cancel');
Route::post('/role/request/{id}',[RequestController::class,'send_request'])->name('request.send');

Route::middleware(['auth','verified'])->group(function(){

// dashboard home
Route::get('/home',[HomeController::class,'index'])->name('home');

//profile

Route::get('/home/profile',[ProfileController::class,'index'])->name('home.profile');

//profile update
Route::post('/home/profile/name',[ProfileController::class,'name_update'])->name('home.profile.name.update');

Route::post('/home/profile/email',[ProfileController::class,'email_update'])->name('home.profile.email.update');

Route::post('/home/profile/password',[ProfileController::class,'password_update'])->name('home.profile.password.update');

//image
Route::post('/home/profile/image',[ProfileController::class,'image_update'])->name('home.profile.image.update');


Route::prefix(env('HOST_NAME'))->middleware('rolecheck')->group(function(){

    Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
    //management user register
    Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
    Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');

    //role
    Route::get('/management/role', [ManagementController::class, 'role_index'])->name('management.role.index');
    Route::post('/management/role/assing', [ManagementController::class, 'role_assign'])->name('management.role.assign');
    Route::post('/management/role/undo/blogger/{id}', [ManagementController::class, 'blogger_grade_down'])->name('management.role.blogger.down');
    Route::post('/management/role/undo/user/{id}', [ManagementController::class, 'user_grade_down'])->name('management.role.user.down');
    Route::get('/management/user/delete/{id}',[ManagementController::class,'user_delete'])->name('management.role.user.delete');
    Route::get('/management/blogger/delete/{id}',[ManagementController::class,'blogger_delete'])->name('management.role.blogger.delete');


// category
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
//category create
Route::post('/category/store',[CategoryController::class,'store'])->name('category.store');
//category edit
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
//category update
Route::post('/category/update/{slug}',[CategoryController::class,'update'])->name('category.update');
//category delete
Route::get('/category/delete/{slug}',[CategoryController::class,'delete'])->name('category.delete');
//category status
Route::post('/category/status/{slug}',[CategoryController::class,'status'])->name('category.status');

// blog

Route::resource('/blog', BlogController::class);
Route::post('/blog/status/{id}',[BlogController::class,'status'])->name('blog.status');

});
});

// email varifiaction routes

Route::get('/email/verify', function () {
  return view('auth.verify');
 })->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
