<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLogin;
// admin 
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
use App\Http\Controllers\admin\CourierCompany;
use App\Http\Controllers\admin\ReginalZone;
use App\Http\Controllers\admin\AdminDomesticRate;
// international 
use App\Http\Controllers\admin\International\RateGroup;

// customer 
use App\Http\Controllers\customer\CustomerRegistrationLogin;
use App\Http\Controllers\customer\CustomerDashboard;
use App\Http\Controllers\customer\DomesticsOrders;
use App\Http\Controllers\customer\InternationalOrders;
use App\Http\Controllers\customer\RateMaster;


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



Route::post('app/login', [CustomerRegistrationLogin::class, 'app_login'])->name('app.login');
Route::post('/store-register', [CustomerRegistrationLogin::class, 'store_register'])->name('store-register');

    // Forgotpassword
    Route::get('/forgotpassword', [CustomerRegistrationLogin::class, 'forgotpassHomepage'])->name('forgotpassword');
    Route::post('/forgotpassOTP', [CustomerRegistrationLogin::class, 'forgotpassOTP'])->name('forgotpassOTP');
Route::group(['middleware' => 'customer'], function () {
    // registration 
    Route::get('/register', [CustomerRegistrationLogin::class, 'index'])->name('register');
    Route::get('/otp-reciving', [CustomerRegistrationLogin::class, 'otpview'])->name('otp-view');
    Route::put('/verify-otp', [CustomerRegistrationLogin::class, 'verify_otp'])->name('verify-otp');
    Route::get('/checkout-category', [CustomerRegistrationLogin::class, 'checkout_category'])->name('checkout-category');
    Route::put('/update-category', [CustomerRegistrationLogin::class, 'update_category'])->name('update-category');
    Route::get('/checkout-category', [CustomerRegistrationLogin::class, 'checkout_category'])->name('checkout-category');
    Route::get('/address-details', [CustomerRegistrationLogin::class, 'address_details'])->name('address-details');
    Route::get('/getpincode', [CustomerRegistrationLogin::class, 'getpincode'])->name('getpincode');
    Route::post('/addressupdate', [CustomerRegistrationLogin::class, 'addressupdate'])->name('addressupdate');
    Route::post('/resend-otp', [CustomerRegistrationLogin::class, 'resendOTP'])->name('resend-otp');
    // login
    Route::get('/sign-in', [CustomerRegistrationLogin::class, 'customer_login'])->name('sign-in');
    // dashboard
    Route::get('app/dashboard', [CustomerDashboard::class, 'index'])->name('app.dashboard');
    Route::get('app/home', [CustomerDashboard::class, 'home'])->name('app.home');
    Route::get('app/logout', [CustomerDashboard::class, 'logout'])->name('app.logout');
    // domestic orders 
    Route::get('app/view-orders',[DomesticsOrders::class,'index'])->name('app.view-orders');
    Route::get('app/add-orders',[DomesticsOrders::class,'add_orders'])->name('app.add-orders');
    Route::post('app/get-pincode',[DomesticsOrders::class,'get_pincode'])->name('app.get-pincode');
    Route::post('app/get-domestic-order',[DomesticsOrders::class,'getModel'])->name('app.get-domestic-order');
    Route::post('app/pickup-address-store',[DomesticsOrders::class,'pickup_address_store'])->name('app.pickup-address-store');
    Route::post('app/store-orders',[DomesticsOrders::class,'store_orders'])->name('app.store-orders');
    Route::post('app/api-booking',[DomesticsOrders::class,'booking_API'])->name('app.api-booking');
    // Domestic rate calculator
    Route::get('app/rate-calculator',action: [DomesticsOrders::class,'rate_calculator'])->name('app.ratecalculator');
    Route::post('app/get-calculator',action: [DomesticsOrders::class,'getRateCalculate'])->name('app.getcalculator');
    // Rate Card 
    Route::get('app/rate-card',[RateMaster::class,'index'])->name('app.rate-card');
    // international orders
    Route::get('app/view-international-orders', [InternationalOrders::class, 'index'])->name('app.view-international-orders');
    Route::get('app/international-order',[InternationalOrders::class,'add_orders'])->name('app.international-order');
    Route::post('app/get-international-order',[InternationalOrders::class,'getModel'])->name('app.get-international-order');
    Route::post('app/store-international',[InternationalOrders::class,'store_orders'])->name('app.store-international');
});


Route::group(['middleware' => 'web'], function () {
    Route::get('admin', [AdminLogin::class, 'index'])->name('admin');
    Route::post('admin/login', [AdminLogin::class, 'Login'])->name('admin.login');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminDashboard::class, 'logout'])->name('admin.logout');
    // User Types Master
    Route::get('admin/view-usertypes', [Adminusertypes::class, 'index'])->name('admin.view-usertypes');
    Route::get('admin/add-usertypes', [Adminusertypes::class, 'add_usertype'])->name('admin.add-usertypes');
    Route::post('admin/store-usertype', [Adminusertypes::class, 'store_usertype'])->name('admin.store-usertype');
    Route::get('admin/edit-usertype/{id}', [Adminusertypes::class, 'editusertype'])->name('admin.edit-usertype');
    Route::put('admin/update-usertypes', [Adminusertypes::class, 'updateUsertype'])->name('admin.update-usertypes');
    Route::put('admin/destroy-usertypes', [Adminusertypes::class, 'destroyUsertype'])->name('admin.destroy-usertypes');
    // user master 
    Route::get('admin/view-user-master', [AdminUserMaster::class, 'index'])->name('admin.view-user-master');
    Route::get('admin/add-user', [AdminUserMaster::class, 'add_user'])->name('admin.add-user');
    Route::post('admin/store-user', [AdminUserMaster::class, 'store_user'])->name('admin.store-user');
    Route::get('admin/edit-user/{id}', [AdminUserMaster::class, 'edit_user'])->name('admin.edit-user');
    Route::put('admin/update-user', [AdminUserMaster::class, 'update_user'])->name('admin.update-user');
    Route::put('admin/delete-user', [AdminUserMaster::class, 'destroyUser'])->name('admin.delete-user');
    // Branch Master
    Route::get('admin/view-branch-master', [BranchMaster::class, 'index'])->name('admin.view-branch-master');
    Route::get('admin/add-branch', [BranchMaster::class, 'add_branch'])->name('admin.add-branch');
    // City Managment 
    Route::get('admin/view-city-managment', [CityMangment::class, 'index'])->name('admin.view-city-managment');
    Route::get('admin/add-city', [CityMangment::class, 'add_city'])->name('admin.add-city');
    // State Managment 
    Route::get('admin/view-state-managment', [StateManagment::class, 'index'])->name('admin.view-state-managment');
    Route::get('admin/add-state', [StateManagment::class, 'add_state'])->name('admin.add-state');
    // Pincode Service
    Route::get('admin/view-pincode-service', [PincodeService::class, 'index'])->name('admin.view-pincode-service');
    Route::get('admin/add-pincode', [PincodeService::class, 'add_pincode'])->name('admin.add-pincode');
    // Rate Group Master 
    Route::get('admin/view-rate-group', [RateGroupMaster::class, 'index'])->name('admin.view-rate-group');
    Route::get('admin/add-rate-group', [RateGroupMaster::class, 'add_group'])->name('admin.add-rate-group');
    Route::post('admin/store-rate-group', [RateGroupMaster::class, 'store_rate'])->name('admin.store-rate-group');
    Route::get('admin/edit-rate-group/{id}', [RateGroupMaster::class, 'edit_rate'])->name('admin.edit-rate-group');
    Route::put('admin/update-rate-group', [RateGroupMaster::class, 'update_rate_group'])->name('admin.update-rate-group');
    Route::put('admin/delete-rate-group', [RateGroupMaster::class, 'destroyRategroup'])->name('admin.delete-rate-group');
    // Fuel Group Master 
    Route::get('admin/view-fuel-group', [FuelGroupMaster::class, 'index'])->name('admin.view-fuel-group');
    Route::get('admin/add-fuel-group', [FuelGroupMaster::class, 'add_group'])->name('admin.add-fuel-group');
    Route::post('admin/store-fuel-group', [FuelGroupMaster::class, 'store_fuel'])->name('admin.store-fuel-group');
    Route::get('admin/edit-fuel-group/{id}', [FuelGroupMaster::class, 'edit_fuel'])->name('admin.edit-fuel-group');
    Route::put('admin/update-fuel-group', [FuelGroupMaster::class, 'update_fuel_group'])->name('admin.update-fuel-group');
    Route::put('admin/delete-fuel-group', [FuelGroupMaster::class, 'destroyFuelgroup'])->name('admin.delete-fuel-group');
    // Customer Business Category
    Route::get('admin/view-business-category', [CustomerBusinessCategory::class, 'index'])->name('admin.view-business-category');
    Route::get('admin/add-business-category', [CustomerBusinessCategory::class, 'add_category'])->name('admin.add-business-category');
    Route::post('admin/store-business-category', [CustomerBusinessCategory::class, 'store_category'])->name('admin.store-business-category');
    Route::get('admin/download-category/{id}', [CustomerBusinessCategory::class, 'downloadImage'])->name('admin.download-category');
    Route::get('admin/edit-business-category/{id}', [CustomerBusinessCategory::class, 'editCategory'])->name('admin.edit-business-category');
    Route::post('admin/update-business-category', [CustomerBusinessCategory::class, 'update_category'])->name('admin.update-business-category');
    Route::put('admin/delete-business-category', [CustomerBusinessCategory::class, 'destroyBusiness_cate'])->name('admin.delete-business-category');
    Route::put('admin/status-business-category', [CustomerBusinessCategory::class, 'statusBusiness'])->name('admin.status-business-category');
    // Courier Master
    Route::get('admin/view-courier-company',[CourierCompany::class,'index'])->name('admin.view-courier-company');
    Route::get('admin/add-courier-company',[CourierCompany::class,'add_courier'])->name('admin.add-courier-company');
    Route::get('admin/edit-courier-company/{id}',[CourierCompany::class,'edit_courier'])->name('admin.edit-courier-company');
    Route::post('admin/store-courier-company',[CourierCompany::class,'store_courier'])->name('admin.store-courier-company');
    Route::get('admin/download-courier/{id}', [CourierCompany::class, 'downloadImage'])->name('admin.download-courier');
    Route::post('admin/update-courier-company',[CourierCompany::class,'update_courier'])->name('admin.update-courier-company');
    Route::put('admin/status-courier-company', [CourierCompany::class, 'status'])->name('admin.status-courier-company');
    Route::put('admin/delete-courier-company',[CourierCompany::class,'destroycorier'])->name('admin.delete-courier-company');
    // Zone Master
    Route::get('admin/view-zone-master',[ReginalZone::class,'index'])->name('admin.view-zone-master');
    Route::get('admin/add-zone',[ReginalZone::class,'add_zone'])->name('admin.add-zone');
    Route::post('admin/get-city',[ReginalZone::class,'getCity'])->name('admin.get-city');
    Route::post('admin/get-edit-city',[ReginalZone::class,'getEditCity'])->name('admin.get-edit-city');
    Route::get('admin/edit-zone/{id}',[ReginalZone::class,'edit_zone'])->name('admin.edit-zone');
    Route::get('admin/view-zone/{id}',[ReginalZone::class,'view_zone'])->name('admin.view-zone');
    Route::post('admin/store-zone',[ReginalZone::class,'store_zone'])->name('admin.store-zone');
    Route::post('admin/update-zone',[ReginalZone::class,'update_zone'])->name('admin.update-zone');
    Route::put('admin/status-zone', [ReginalZone::class, 'status'])->name('admin.status-zone');
    Route::put('admin/delete-zone',[ReginalZone::class,'destroyzone'])->name('admin.delete-zone');

    //  Domestic Rate Master
    Route::get('admin/view-domestic-rate',[AdminDomesticRate::class,'index'])->name('admin.view-domestic-rate');
    Route::get('admin/view-domestic-details-rate/{id}',[AdminDomesticRate::class,'view_details_rate'])->name('admin.view-domestic-details-rate');
    Route::get('admin/add-rate',[AdminDomesticRate::class,'add_rate'])->name('admin.add-rate');
    Route::post('admin/store-rate',[AdminDomesticRate::class,'store_rate'])->name('admin.stor-rate');

    // International 
    // Rate Group
    Route::get('admin/view-inet-rate-group',[RateGroup::class,'index'])->name('admin.view-inet-rate-group');
    Route::get('admin/add-inet-rate-group',[RateGroup::class,'add_group'])->name('admin.add-inet-rate-group');
    Route::post('admin/store-inet-rate-group', [RateGroup::class, 'store_rate'])->name('admin.store-inet-rate-group');
    Route::get('admin/edit-inet-rate-group/{id}', [RateGroup::class, 'edit_rate'])->name('admin.edit-inet-rate-group');
    Route::put('admin/update-inet-rate-group', [RateGroup::class, 'update_rate_group'])->name('admin.update-inet-rate-group');
    Route::put('admin/delete-inet-rate-group', [RateGroup::class, 'destroyRategroup'])->name('admin.delete-inet-rate-group');
    Route::put('admin/status-inet-rate-group', [RateGroup::class, 'status'])->name('admin.status-inet-rate-group');
});