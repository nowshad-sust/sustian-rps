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

Route::get('/',function(){
	return Redirect::route('dashboard');
});

Route::group(['before' => 'guest'], function(){
	Route::controller('password', 'RemindersController');
	Route::get('login', ['as'=>'login','uses' => 'AuthController@login']);
	Route::post('login', array('uses' => 'AuthController@doLogin'));
	Route::get('register',['as'=>'register','uses'=>'UserController@showRegisterForm']);
	Route::post('register',['uses'=>'UserController@validateRegistration']);
	Route::get('register/activation/{key}',['uses'=>'ActivationController@activate']);
	Route::get('activationRequest', ['as'=>'activationRequest', 'uses'=>'ActivationController@viewActivationRequest']);
	Route::post('sendActivationLink',['as'=>'sendActivationLink','uses'=>'ActivationController@sendActivationLink']);
});

Route::group(array('before' => 'auth|activation'), function()
{
	//login section
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'AuthController@dashboard'));
	Route::get('change-password', array('as' => 'password.change', 'uses' => 'AuthController@changePassword'));
	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'AuthController@doChangePassword'));

	//profile section
	Route::get('profile', ['as'=>'profile', 'uses'=>'UserController@viewProfile']);
	Route::get('updateProfile',['as'=>'updateProfile', 'uses'=>'UserController@showProfileUpdateForm']);
	Route::post('updateProfile',['as'=>'updateProfile', 'uses'=>'UserController@validateProfileUpdate']);
	Route::get('uploadAvatar',['as'=>'uploadAvatar', 'uses'=>'UserController@uploadAvatarForm']);
	Route::post('uploadAvatar',['as'=>'uploadAvatar', 'uses'=>'UserController@uploadAvatar']);

	//all freelancers grid
	Route::get('classmates',['as'=>'classmates', 'uses'=>'UserController@showClassmates']);
	//others profile view
	Route::get('showProfile/{id}', ['as'=>'showProfile', 'uses'=>'UserController@showOthersProfile']);
});
