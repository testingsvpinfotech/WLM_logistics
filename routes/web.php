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
use App\Http\Controllers\admin\International\InternationalZoneMaster;
use App\Http\Controllers\admin\International\InternationalRateMaster;
// Wallet 
use App\Http\Controllers\admin\AdminWalletTrasection;
//  user type permission
use App\Http\Controllers\admin\AdminPermissions;  
use App\Http\Controllers\admin\AdminOrders;  
use App\Http\Controllers\admin\CustomerMaster;  
use App\Http\Controllers\admin\DomesticInvoice;  
use App\Http\Controllers\admin\DomesticFuel;  
use App\Http\Controllers\admin\CourierPincodes;  

// customer 
use App\Http\Controllers\customer\CustomerRegistrationLogin;
use App\Http\Controllers\customer\CustomerDashboard;
use App\Http\Controllers\customer\DomesticsOrders;
use App\Http\Controllers\customer\InternationalOrders;
use App\Http\Controllers\customer\RateMaster;
use App\Http\Controllers\customer\CustomerWalletTrasection;


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


Route::get('/', [CustomerRegistrationLogin::class, 'index'] );  


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
    Route::get('app/get-ewayacess',[DomesticsOrders::class,'GetEwayAccess'])->name('app.get-ewayacess');
    Route::get('app/view-Unprocessing-orders',[DomesticsOrders::class,'UnprocessOrders'])->name('app.view-Unprocessing-orders');
    Route::get('app/view-Processing-orders',[DomesticsOrders::class,'ProcessOrders'])->name('app.view-Processing-orders');
    Route::get('app/view-readyforship-orders',[DomesticsOrders::class,'readyforship'])->name('app.view-readyforship-orders');
    Route::get('app/view-manifest-orders',[DomesticsOrders::class,'Manifest'])->name('app.view-manifest-orders');
    Route::get('app/view-return-orders',[DomesticsOrders::class,'returnOrders'])->name('app.view-return-orders');
    Route::get('app/add-orders',[DomesticsOrders::class,'add_orders'])->name('app.add-orders');
    Route::post('app/get-pincode',[DomesticsOrders::class,'get_pincode'])->name('app.get-pincode');
    Route::post('app/get-domestic-order',[DomesticsOrders::class,'getModel'])->name('app.get-domestic-order');
    Route::post('app/pickup-address-store',[DomesticsOrders::class,'pickup_address_store'])->name('app.pickup-address-store');
    Route::post('app/store-orders',[DomesticsOrders::class,'store_orders'])->name('app.store-orders');
    Route::post('app/api-booking',[DomesticsOrders::class,'booking_API'])->name('app.api-booking');

    // cancel orders 
    Route::get('app/get-cancel-order',[DomesticsOrders::class,'getOrders'])->name('app.get-cancel-order');
    Route::post('app/update-cancel-order',[DomesticsOrders::class,'updateCanelOrders'])->name('app.update-cancel-order');

    // B2B Domestic Booking 
    Route::get('app/add-b2b-order',[DomesticsOrders::class,'add_b2b_orders'])->name('app.add-b2b-order');
    Route::post('app/store-b2b-booking',[DomesticsOrders::class,'storeb2bBooking'])->name('app.b2bbooking-store');
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
    Route::get('app/get-country',[InternationalOrders::class,'getcoutry'])->name('app.get-country');
    // Wallet Transection 
    Route::get('app/view-wallet-transaction',[CustomerWalletTrasection::class,'index'])->name('app.view-wallet-transaction');
    // Tracking Shipment 
    Route::get('app/tracking-shipment',[DomesticsOrders::class,'shipmentTracking'])->name('app.tracking-shipment');
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
    Route::get('admin/view-domestic-zone-master', [ReginalZone::class, 'index'])->name('admin.view-domestic-zone-master');
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
    Route::get('admin/get-domestic-zone',[AdminDomesticRate::class,'getzone'])->name('admin.get-domestic-zone');
    // International 
    // Rate Group
    Route::get('admin/view-inet-rate-group',[RateGroup::class,'index'])->name('admin.view-inet-rate-group');
    Route::get('admin/add-inet-rate-group',[RateGroup::class,'add_group'])->name('admin.add-inet-rate-group');
    Route::post('admin/store-inet-rate-group', [RateGroup::class, 'store_rate'])->name('admin.store-inet-rate-group');
    Route::get('admin/edit-inet-rate-group/{id}', [RateGroup::class, 'edit_rate'])->name('admin.edit-inet-rate-group');
    Route::put('admin/update-inet-rate-group', [RateGroup::class, 'update_rate_group'])->name('admin.update-inet-rate-group');
    Route::put('admin/delete-inet-rate-group', [RateGroup::class, 'destroyRategroup'])->name('admin.delete-inet-rate-group');
    Route::put('admin/status-inet-rate-group', [RateGroup::class, 'status'])->name('admin.status-inet-rate-group');

    // International Zone
    Route::get('admin/view-zone-master', [InternationalZoneMaster::class,'index'])->name('admin.view-zone-master');
    Route::get('admin/export-zone-master', [InternationalZoneMaster::class,'export_zone_file'])->name('admin.export-zone-master');
    Route::get('admin/view-add-zone', [InternationalZoneMaster::class,'add_zone'])->name('admin.view-add-zone');
    Route::post('admin/store-add-zone', [InternationalZoneMaster::class,'store_zone'])->name('admin.store-add-zone');
    Route::get('admin/view-zone-details/{id1}/{id2}',[InternationalZoneMaster::class,'getZoneData'])->name('admin.view-zone-details');
    Route::put('admin/zone-destryment', [InternationalZoneMaster::class, 'status'])->name('admin.zone-destryment');

    // International Rate
    Route::get('admin/view-international-rate',[InternationalRateMaster::class,'index'])->name('admin.view-international-rate');
    Route::get('admin/export-rate-master', [InternationalRateMaster::class,'export_zone_file'])->name('admin.export-rate-master');
    Route::get('admin/view-add-rate-master',[InternationalRateMaster::class,'add_rate'])->name('admin.view-add-rate-master');
    Route::post('admin/view-store-rate-master',[InternationalRateMaster::class,'store_rate'])->name('admin.view-store-rate-master');
    Route::get('admin/view-intRate-details/{id1}/{id2}/{id3}/{id4}',[InternationalRateMaster::class,'getRateData'])->name( 'admin.view-intRate-details');
    Route::put('admin/rate-destryment', [InternationalRateMaster::class, 'Ratedelete'])->name('admin.rate-destryment');

    // Wallet Transection 
    Route::get('admin/view-wallet-transaction',[AdminWalletTrasection::class,'index'])->name('admin.view-wallet-transaction');
    Route::get('admin/add-toup-transaction',[AdminWalletTrasection::class,'add_topup'])->name('admin.add-toup-transaction');
    Route::post('admin/store-toup-transaction',[AdminWalletTrasection::class,'store_topup'])->name('admin.store-toup-transaction');

    //  User type Permissions
    Route::get('admin/permisssion-update/{id}',[AdminPermissions::class,'edit_permission'])->name('admin.permisssion-update');
    Route::put('admin/permisssion-update-data',[AdminPermissions::class,'update_permission'])->name('admin.permisssion-update-data');
     
    // Admin panel orders
     Route::get('admin/view-customers-all-order',[AdminOrders::class,'index'])->name('admin.view-customers-all-order'); 
     Route::get('admin/view-Unprocessing-orders',[AdminOrders::class,'UnprocessOrders'])->name('admin.view-Unprocessing-orders'); 
     Route::get('admin/view-Processing-orders',[AdminOrders::class,'ProcessOrders'])->name('admin.view-Processing-orders'); 
     Route::get('admin/view-readyforship-orders',[AdminOrders::class,'readyforship'])->name('admin.view-readyforship-orders'); 
     Route::get('admin/view-manifest-orders',[AdminOrders::class,'Manifest'])->name('admin.view-manifest-orders'); 
     Route::get('admin/view-return-orders',[AdminOrders::class,'returnOrders'])->name('admin.view-return-orders'); 

    //  customers
    Route::get('admin/view-customer-master',[CustomerMaster::class,  'index'])->name('admin.view-customer-master'); 
    Route::get('admin/edit-customer/{id}',[CustomerMaster::class,  'edit_customer'])->name('admin.edit-customer'); 
    Route::post('admin/update-customer',[CustomerMaster::class,  'update_customer'])->name('admin.update-customer'); 

    //  Fuel Master
    Route::get('admin/view-domestic-fuel-master',[DomesticFuel::class,'index'])->name('admin.view-domestic-fuel-master');
    Route::get('admin/add-domestic-fuel',[DomesticFuel::class,'add_fuel'])->name('admin.add-domestic-fuel');
    Route::post('admin/fuel-master-store',[DomesticFuel::class,'store_fuel'])->name('admin.fuel-master-store');
    Route::get('admin/edit-fuel-master/{id}',[DomesticFuel::class,'edit_fuel'])->name('admin.edit-fuel-master');
    Route::post('admin/fuel-master-update',[DomesticFuel::class,'fuel_update'])->name('admin.fuel-master-update');
    Route::put('admin/fuel-master-delete',[DomesticFuel::class,'destroyfuel'])->name('admin.fuel-master-delete');

    //  Download route 
    Route::get('admin/download-document/{id}', [CustomerMaster::class, 'downloadImage'])->name('admin.download-document');
    Route::put('admin/verify-document', [CustomerMaster::class, 'VerifyData'])->name('admin.verify-document');
    Route::put('admin/disbaled-account', [CustomerMaster::class, 'disabled'])->name('admin.disbaled-account');

    // Domestic Billing 
    Route::get('admin/invoice-cycle1-billed',[DomesticInvoice::class,'index'])->name('admin.invoice-cycle1-billed');
    Route::get('admin/invoice-billed-cycle2',[DomesticInvoice::class,'View_billed_cycle2'])->name('admin.invoice-billed-cycle2');
    Route::get('admin/invoice-print',[DomesticInvoice::class,'view_invoice_print'])->name('admin.invoice-print');
    Route::get('admin/invoice-create',[DomesticInvoice::class,'add_invoice'])->name('admin.invoice-create');
    Route::get('admin/invoice-cycle1-pending',[DomesticInvoice::class,'invoice_cycle1_pending'])->name('admin.invoice-cycle1-pending');
    Route::get('admin/invoice-pending-cycle2',[DomesticInvoice::class,'invoice_cycle2_pending'])->name('admin.invoice-pending-cycle2');

    //  Courier wise Pincode 
    Route::get('admin/find-courier-pincode',[CourierPincodes::class,'find_pincode'])->name('admin.find-courier-pincode');
    Route::get('admin/add-courier-pincode',[CourierPincodes::class,'index'])->name('admin.add-courier-pincode');
    Route::get('admin/download-courier-pincode',[CourierPincodes::class,'export_zone_file'])->name('admin.download-courier-pincode');
    Route::post('admin/upload-domestic-pincode',[CourierPincodes::class,'store_pincode'])->name('admin.upload-domestic-pincode');
});