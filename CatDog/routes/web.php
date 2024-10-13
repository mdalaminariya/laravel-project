<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CatBlogController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register'=>false]);

//frontend
Route::get('/',[FrontendHomeController::class,'index'])->name('frontend');
Route::get('/category/{slug}',[CatBlogController::class,'show'])->name('frontend.cat.blog');
Route::get('/blogs',[FrontendBlogController::class,'index'])->name('frontend.blogs');
Route::get('/blog/single/{slug}',[FrontendBlogController::class,'single'])->name('frontend.blog.single');
Route::post('/blog/comment/{id}',[FrontendBlogController::class,'comment'])->name('frontend.blog.comment');


//dashboard Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//management

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
});


//profile

Route::get('/home/profile',[ProfileController::class,'index'])->name('home.profile');

//profile update
Route::post('/home/profile/name',[ProfileController::class,'name_update'])->name('home.profile.name.update');

Route::post('/home/profile/email',[ProfileController::class,'email_update'])->name('home.profile.email.update');

Route::post('/home/profile/password',[ProfileController::class,'password_update'])->name('home.profile.password.update');

//image
Route::post('/home/profile/image',[ProfileController::class,'image_update'])->name('home.profile.image.update');

//catagory
Route::get('/category',[CategoryController::class,'index'])->name('category.index');
//category create
Route::post('/category/store',[CategoryController::class,'store'])->name('category.index.store');
//catagory edit
Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('category.index.edit');
//category update
Route::post('/category/update/{slug}',[CategoryController::class,'update'])->name('category.index.update');
//category delete
Route::get('/category/delete/{slug}',[CategoryController::class,'delete'])->name('category.index.delete');
//category status
Route::post('/category/status/{slug}',[CategoryController::class,'status'])->name('category.index.status');

//blog

Route::resource('/blog', BlogController::class);
Route::post('/blog/status/{id}',[BlogController::class,'status'])->name('blog.status');
