<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\admin\AdminDashboard;
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
});