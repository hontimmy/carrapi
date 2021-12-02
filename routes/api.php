<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'API\UserAPIController@login');
Route::post('register', 'API\UserAPIController@register');
Route::post('send_reset_link_email', 'API\UserAPIController@sendResetLinkEmail');
Route::get('send_sms', 'API\UserAPIController@sendVerificationSms');
Route::get('verify_code', 'API\UserAPIController@VerifyCode');
Route::get('resend_sms', 'API\UserAPIController@resentOTP');
Route::get('user', 'API\UserAPIController@user');
Route::get('logout', 'API\UserAPIController@logout');

Route::resource('option_groups', 'API\OptionGroupAPIController');
Route::resource('options', 'API\OptionAPIController');
Route::resource('categories', 'API\CategoryAPIController');

//Service Listing public
Route::get('e_services/featured', 'API\ServiceController@ServiveFeat');
Route::get('e_services/popular', 'API\ServiceController@ServivePopular');
Route::get('e_services/top_rated', 'API\ServiceController@ServiveTopRated');
Route::get('e_services/search', 'API\ServiceController@searchService');
Route::resource('e_services', 'API\EServiceAPIController');

//Review public
Route::get('e_service_reviews/{id}', 'API\EServiceReviewAPIController@show')->name('e_service_reviews.show');
Route::get('e_service_reviews', 'API\EServiceReviewAPIController@index')->name('e_service_reviews.index');

//Vendor/Provider public 
Route::resource('e_providers', 'API\EProviderAPIController');
Route::resource('availability_hours', 'API\AvailabilityHourAPIController');


Route::resource('galleries', 'API\GalleryAPIController');


// Signed In Routes
Route::middleware('auth:api')->group(function () {

    Route::get('validatebvn', 'API\UserAPIController@validatebvn');
    Route::post('storebvn', 'API\UserAPIController@Addvalidatebvn');
    Route::post('validateaccount', 'API\UserAPIController@validateaccount');
    Route::post('addwithdrawal', 'API\UserAPIController@addwithdrawal');
    Route::get('banklist', 'API\UserAPIController@banklist');
    Route::post('e_service_reviews', 'API\EServiceReviewAPIController@store')->name('e_service_reviews.store');
    Route::resource('favorites', 'API\FavoriteAPIController');
    Route::resource('addresses', 'API\AddressAPIController');
    Route::get('balance', 'API\CustomAPIController@walletBalance');


    Route::post('users/{id}', 'API\UserAPIController@update');
    Route::get('dashboard', 'API\DashboardAPIController@provider');
    Route::resource('e_providers', 'API\EProvider\EProviderAPIController');
    Route::resource('notifications', 'API\NotificationAPIController');
    Route::get('e_service_reviews', 'API\EServiceReviewAPIController@index')->name('e_service_reviews.index');
    Route::get('e_services', 'API\EServiceAPIController@index')->name('e_services.index');

    Route::post('uploads/store', 'API\UploadAPIController@store');
    Route::post('uploads/clear', 'API\UploadAPIController@clear');
    Route::post('users/{id}', 'API\UserAPIController@update');

    Route::get('payments/byMonth', 'API\PaymentAPIController@byMonth')->name('payments.byMonth');
    Route::resource('payments', 'API\PaymentAPIController')->except(['update']);
    Route::resource('payment_methods', 'API\PaymentMethodAPIController')->only([
        'index'
    ]);
    Route::resource('earnings', 'API\EarningAPIController');
    Route::resource('e_provider_payouts', 'API\EProviderPayoutAPIController');

    Route::get('notifications/count', 'API\NotificationAPIController@count');
    Route::resource('notifications', 'API\NotificationAPIController');
    Route::resource('bookings', 'API\BookingAPIController');
});
