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
use App\Http\Controllers\admin\RateGroupMaster;
use App\Http\Controllers\admin\FuelGroupMaster;
use App\Http\Controllers\admin\CustomerBusinessCategory;
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
    // Rate Group Master 
    Route::get('admin/view-rate-group',[RateGroupMaster::class,'index'])->name('admin.view-rate-group');
    Route::get('admin/add-rate-group',[RateGroupMaster::class,'add_group'])->name('admin.add-rate-group');
    Route::post('admin/store-rate-group',[RateGroupMaster::class,'store_rate'])->name('admin.store-rate-group');
    Route::get('admin/edit-rate-group/{id}',[RateGroupMaster::class,'edit_rate'])->name('admin.edit-rate-group');
    Route::put('admin/update-rate-group',[RateGroupMaster::class,'update_rate_group'])->name('admin.update-rate-group');
    Route::put('admin/delete-rate-group',[RateGroupMaster::class,'destroyRategroup'])->name('admin.delete-rate-group');
    // Fuel Group Master 
    Route::get('admin/view-fuel-group',[FuelGroupMaster::class,'index'])->name('admin.view-fuel-group');
    Route::get('admin/add-fuel-group',[FuelGroupMaster::class,'add_group'])->name('admin.add-fuel-group');
    Route::post('admin/store-fuel-group',[FuelGroupMaster::class,'store_fuel'])->name('admin.store-fuel-group');
    Route::get('admin/edit-fuel-group/{id}',[FuelGroupMaster::class,'edit_fuel'])->name('admin.edit-fuel-group');
    Route::put('admin/update-fuel-group',[FuelGroupMaster::class,'update_fuel_group'])->name('admin.update-fuel-group');
    Route::put('admin/delete-fuel-group',[FuelGroupMaster::class,'destroyFuelgroup'])->name('admin.delete-fuel-group');
    // Customer Business Category
    Route::get('admin/view-business-category',[CustomerBusinessCategory::class,'index'])->name('admin.view-business-category');
    Route::get('admin/add-business-category',[CustomerBusinessCategory::class,'add_category'])->name('admin.add-business-category');
    Route::post('admin/store-business-category',[CustomerBusinessCategory::class,'store_category'])->name('admin.store-business-category');
    Route::get('admin/download-category/{id}',[CustomerBusinessCategory::class,'downloadImage'])->name('admin.download-category');
    Route::get('admin/edit-business-category/{id}',[CustomerBusinessCategory::class,'editCategory'])->name('admin.edit-business-category');
    Route::post('admin/update-business-category',[CustomerBusinessCategory::class,'update_category'])->name('admin.update-business-category');
    Route::put('admin/delete-business-category',[CustomerBusinessCategory::class,'destroyBusiness_cate'])->name('admin.delete-business-category');
    Route::put('admin/status-business-category',[CustomerBusinessCategory::class,'statusBusiness'])->name('admin.status-business-category');
});