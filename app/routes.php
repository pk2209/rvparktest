<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Route to all page that need authentication,for both provider and admin
 */
Route::group(
    array(
        'before'    => 'auth.user'
    ),
    function(){
        Route::get('/','UserController@index');
        Route::get('/dashboard','UserController@index');
        Route::get('user/info', 'UserController@info');
        Route::post('user/info', 'UserController@saveInfo');

        /** route to offer page */
        Route::resource('offer', 'OfferController');

        /** route to customer page */
        Route::resource('customer', 'CustomerController');

        /** route to calendar page */
        Route::resource('calendar', 'CalendarController');

        Route::get('zipcode', 'ZipCodeController@index');
        Route::post('invite', 'InvitationController@store');

        /** route to upload handler */
        Route::get('upload/offer-image', 'UploadController@offerImageForm');
        Route::post('upload/offer-image', 'UploadController@offerImageProcess');
    }
);

/**
 * Route to all page that need admin authentication
 */
Route::group(
    array(
        'prefix'    => 'admin',
        'before'    => 'auth.admin'
    ),
    function(){
        Route::resource('offer', 'OfferController');

        Route::put('provider/restore/{id}', 'ProviderController@restore');
        Route::resource('provider', 'ProviderController');
    }
);


/**
 * Route to admin login and logout
 */
Route::group(
    array(
        'prefix'    => 'user'
    ),function(){
        Route::get('login','AuthenticationController@login');
        Route::get('logout','AuthenticationController@logout');

        Route::post('login','AuthenticationController@doLogin');
        Route::post('reset', 'AuthenticationController@doReset');
        Route::post('signup', 'AuthenticationController@doSignup');
    }
);

Route::get('login','AuthenticationController@login');
Route::get('logout','AuthenticationController@logout');

Route::post('login','AuthenticationController@doLogin');
Route::post('reset', 'AuthenticationController@doReset');
Route::post('signup', 'AuthenticationController@doSignup');