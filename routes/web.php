<?php

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
    Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

   return " Cache is cleared!";

   });
  


Route::get('/link', function() {
    $exitCode = Artisan::call('storage:link');
    return 'link cleared';
});


Route::get('/link', function() {
    $exitCode = Artisan::call('storage:link');
});

Route::get('listen', function() {
    return Artisan::call('queue:listen');
});


Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'Admin','prefix'=>'admin', 'as' => 'admin.'],function(){

	Route::match(['GET','POST'],'reset-password/{reset_password_token?}','ProfileController@resetPassword')->name('resetPassword');

    Route::get('password-reset-success','ProfileController@viewMessageResetPassword')->name('passwordReset');

    //property Management
    Route::match(['GET','POST'],'property','PropertyController@property')->name('property');
    Route::match(['GET','POST'],'add-property','PropertyController@addProperty')->name('addProperty');
    Route::match(['GET','POST'],'edit-property/{id}','PropertyController@editProperty')->name('editProperty');
    Route::get('view-property/{id}','PropertyController@viewProperty')->name('viewProperty');

    Route::get('new-property-management','PropertyController@newPropertyManagement')->name('newPropertyManagement');

    Route::get('new-property-management-view/{id}','PropertyController@newPropertyManagementView')->name('newPropertyManagementView');
    Route::post('delete-property','PropertyController@deleteProperty')->name('deleteProperty');

     Route::match(['Get','Post'],'AcceptPropertyRequest/{id}','PropertyController@AcceptPropertyRequest')->name('AcceptPropertyRequest');
     Route::match(['Get','Post'],'RejectPropertyRequest/{id}','PropertyController@RejectPropertyRequest')->name('RejectPropertyRequest');

    //subscription management

    Route::get('subscription-management','SubscriptionController@subscriptionManagement')->name('subscriptionManagement');
    Route::match(['GET','POST'],'add-subscription','SubscriptionController@addSubscription')->name('addSubscription');

    Route::match(['GET','POST'],'edit-subscription/{id}','SubscriptionController@editSubscription')->name('editSubscription');

    Route::get('view-subscription/{id}','SubscriptionController@viewSubscription')->name('viewSubscription');
    Route::get('cancel-subscription/{id}','SubscriptionController@cancelSubscription')->name('cancelSubscription');



    //manage account

    Route::match(['GET','POST'],'manage-account','ProfileController@manageAccount')->name('manageAccount');

    Route::match(['GET','POST'],'update-password','ProfileController@updatePassword')->name('updatePassword');

    Route::match(['GET','POST'],'login','ProfileController@login')->name('login');

    Route::match(['GET','POST'],'forgot-password','ProfileController@forgotPassword')->name('forgotPassword');

});

Route::group(['middleware'=>['admin'], 'namespace' => 'Admin','prefix'=>'admin', 'as' => 'admin.'], function() {
        Route::match(['GET','POST'],'dashboard','DashboardController@dashboard')->name('dashboard');

        Route::get('logout','ProfileController@logout')->name('logout');

    //User Management
    Route::match(['GET','POST'],'user-management','UserController@userManagement')->name('userManagement');
    Route::match(['GET','POST'],'add-user','UserController@addUser')->name('addUser');
    Route::match(['GET','POST'],'check-exist-email/{user_id?}', 'UserController@checkEmail');
    Route::match(['GET','POST'],'edit-user/{user_id}','UserController@editUser')->name('editUser');
    Route::get('view-user/{user_id}','UserController@viewUser')->name('viewUser');

    Route::get('block-user/{user_id}','UserController@blockUser')->name('blockUser');
    Route::post('delete-user','UserController@deleteUser')->name('deleteUser');

});








//USER ROUTES API
Route::get('confirm-account/{verify_email_token?}','Api\v1\AuthenticateController@confirmAccount')->name('confirmAccount');

Route::get('password-reset-success','Api\v1\AuthenticateController@viewMessageResetPassword')->name('passwordReset');
Route::get('password-reset-invalid','Api\v1\AuthenticateController@viewMessageResetPasswordInvalid')->name('passwordResetInvalid');
Route::match(['GET','POST'],'reset-password/{reset_password_token?}','Api\v1\AuthenticateController@resetPassword')->name('resetPassword');
//END USER ROUTES
