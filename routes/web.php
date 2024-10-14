<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\admin\AdminDashboard;
use App\Http\Controllers\admin\Adminusertypes;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware'=>'web'],function(){
    Route::get('admin',[AdminLogin::class,'index'])->name('admin');
    Route::post('admin/login',[AdminLogin::class,'Login'])->name('admin.login');
});

Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/dashboard',[AdminDashboard::class,'index'])->name('admin.dashboard');
    Route::get('admin/logout',[AdminDashboard::class,'logout'])->name('admin.logout');
   // User Types Master
   Route::get('admin/view-usertypes',[Adminusertypes::class,'index'])->name('admin.view-usertypes');
   Route::get('admin/add-usertypes',[Adminusertypes::class,'add_usertype'])->name('admin.add-usertypes');
   Route::post('admin/store-usertype',[Adminusertypes::class,'store_usertype'])->name('admin.store-usertype');
   Route::get('admin/edit-usertype/{id}',[Adminusertypes::class,'editusertype'])->name('admin.edit-usertype');
   Route::put('admin/update-usertypes',[Adminusertypes::class,'updateUsertype'])->name('admin.update-usertypes');
   Route::put('admin/destroy-usertypes',[Adminusertypes::class,'destroyUsertype'])->name('admin.destroy-usertypes');
    
});