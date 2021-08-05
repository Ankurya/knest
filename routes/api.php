<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => 'Api\v1', 'prefix' => 'v1'], function(){

	Route::post('register','AuthenticateController@register');

	Route::post('login','AuthenticateController@login');

	Route::post('forgot-password','AuthenticateController@forgotPassword');
    Route::get('get-admin-data','ApiController@getAdmin');


	Route::group(['middleware' => ['auth:api','check_user_status']], function(){

    Route::match(['GET','POST'],'profile','AuthenticateController@updateProfile');

	Route::get('logout','AuthenticateController@logout');

    Route::post('add-property','ApiController@addProperty');

    Route::match(['GET','POST'],'get-property','ApiController@getProperty');
    
    Route::post('add-update-favourite','ApiController@addFavourite');
    
    Route::get('get-favourite-list','ApiController@getFavouriteList');
    
    Route::get('my-property-list','ApiController@myPropertyList');

    Route::match(['GET','POST'],'past-property-list','ApiController@pastPropertyList');

    Route::match(['GET','POST'],'upcoming-property-list','ApiController@upcomingPropertyList');

    Route::post('update-property','ApiController@updateProperty');
    
    Route::post('add-Interested','ApiController@addInterested');

    Route::get('notification-list','ApiController@notificationList');
    Route::match(['GET','POST'],'notification-detail','ApiController@notificationDetail');

	
	Route::post('interested-list','ApiController@getInterestedList');
    Route::post('property-list-lat-lng','ApiController@propertyListLatLng');
    Route::post('upload-property-image','ApiController@uploadPropertyImage');
    Route::get('delete-property-image/{image_id}','ApiController@deletePropertyImage');

    Route::get('user-interest-in-property','ApiController@userInterestInProperty');
    // Route::match(['GET','POST'],'intrested-user-detail','ApiController@intrestedUsersDetail');

    Route::match(['GET','POST'],'change-password','ApiController@changePassword');

    Route::match(['GET','POST'],'add-subscription','ApiController@addSubscription');

    Route::post('send-chat-message','ApiController@sendChatMessage');

        Route::post('receiver-message-detail','ApiController@receiverMessageDetail');

	});

});