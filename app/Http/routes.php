<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middlewareGroups' => 'web'], function() {
	Route::auth();
    // Place all your web routes here...
	Route::any('/','UserController@getLogin');
    Route::any('home','UserController@getDashboard');

	//HomeController
	Route::post('home/contact','HomePageController@postContact');

	//UserController
	Route::get('user/login','UserController@getLogin');
	Route::post('user/login','UserController@postLogin');
	Route::post('user/register','UserController@postRegister');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');

	//Route::group(['middleware' => ['auth','permission']], function() {
	Route::group(['middleware' => ['auth', 'web', 'permission', 'subscription']], function() {

        //Profile
        Route::any('user/dashboard','UserController@getDashboard');
        Route::any('user/profile','UserController@getProfile');

	});

	//Routes without permission handling
    Route::group(['middleware' => ['auth', 'web']], function() {
        Route::any('report/email','ReportController@getEmailReport');
        Route::any('report/sms','ReportController@getSmsReport');
        Route::any('report/whatsapp','ReportController@getWhatsAppReport');

        Route::post('generate/email','ReportController@postEmailReport');
        Route::post('generate/sms','ReportController@postSmsReport');
        Route::post('generate/whatsapp','ReportController@postWhatsAppReport');
    });

});
