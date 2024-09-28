<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontedController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes(['register'=>false]);

Route::get('/',[FrontedController::class,'index'])->name('root');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//management
Route::get('/management', [ManagementController::class, 'index'])->name('management.index');
//management user register
Route::post('/management/user/register', [ManagementController::class, 'store_register'])->name('management.store');
Route::post('/management/user/manager/down/{id}', [ManagementController::class, 'manager_down'])->name('management.down');

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
