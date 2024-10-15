<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
use App\Http\Controllers\admin\AdminDashboard;
use App\Http\Controllers\admin\Adminusertypes;
use App\Http\Controllers\admin\AdminUserMaster;
use App\Http\Controllers\admin\BranchMaster;
use App\Http\Controllers\admin\CityMangment;
use App\Http\Controllers\admin\StateManagment;
use App\Http\Controllers\admin\PincodeService;
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
   // user master 
    Route::get('admin/view-user-master',[AdminUserMaster::class,'index'])->name('admin.view-user-master');
    Route::get('admin/add-user',[AdminUserMaster::class,'add_user'])->name('admin.add-user');
    Route::post('admin/store-user',[AdminUserMaster::class,'store_user'])->name('admin.store-user');
    Route::get('admin/edit-user/{id}',[AdminUserMaster::class,'edit_user'])->name('admin.edit-user');
    Route::put('admin/update-user',[AdminUserMaster::class,'update_user'])->name('admin.update-user');
    Route::put('admin/delete-user',[AdminUserMaster::class,'destroyUser'])->name('admin.delete-user');
    // Branch Master
    Route::get('admin/view-branch-master',[BranchMaster::class,'index'])->name('admin.view-branch-master');
    Route::get('admin/add-branch',[BranchMaster::class,'add_branch'])->name('admin.add-branch');
    // City Managment 
    Route::get('admin/view-city-managment',[CityMangment::class,'index'])->name('admin.view-city-managment');
    Route::get('admin/add-city',[CityMangment::class,'add_city'])->name('admin.add-city');
    // State Managment 
    Route::get('admin/view-state-managment',[StateManagment::class,'index'])->name('admin.view-state-managment');
    Route::get('admin/add-state',[StateManagment::class,'add_state'])->name('admin.add-state');
    // Pincode Service
    Route::get('admin/view-pincode-service',[PincodeService::class,'index'])->name('admin.view-pincode-service');
    Route::get('admin/add-pincode',[PincodeService::class,'add_pincode'])->name('admin.add-pincode');
});