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
	Route::post('updateProfile',['as'=>'storeProfile', 'uses'=>'UserController@validateProfileUpdate']);
	Route::get('uploadAvatar',['as'=>'uploadAvatar', 'uses'=>'UserController@uploadAvatarForm']);
	Route::post('uploadAvatar',['as'=>'storeAvatar', 'uses'=>'UserController@uploadAvatar']);

	//all freelancers grid
	Route::get('classmates',['as'=>'classmates', 'uses'=>'UserController@showClassmates']);
	//others profile view
	Route::get('showProfile/{id}', ['as'=>'showProfile', 'uses'=>'UserController@showOthersProfile']);

	//STAT section
	Route::get('resultsDataTable',['as'=>'resultsDataTable', 'uses'=>'StatController@showResultsDataTable']);
	Route::get('addResult',['as'=>'addResult', 'uses'=>'StatController@addResultForm']);
	Route::post('addResult',['as'=>'addResult', 'uses'=>'StatController@validateResult']);
	Route::get('editResult/{id}',['as'=>'editResult', 'uses'=>'StatController@showResultEditForm']);
	Route::post('editResult',['as'=>'updateResult', 'uses'=>'StatController@updateResult']);
	Route::get('deleteResult/{id}',['as'=>'deleteResult', 'uses'=>'StatController@deleteResult']);

	//chart section
	Route::get('chart',['as'=>'chart','uses'=>'ChartController@showChart']);

	Route::get('gpa',['as'=>'gpa','uses'=>'ChartController@calculateGPA']);
});

Route::group(array('before' => 'auth|admin'), function()
{
	//notification section
	Route::get('addNotification',['as'=>'addNotification', 'uses'=>'AdminController@showNotificationForm']);
	Route::post('addNotification',['as'=>'addNotification', 'uses'=>'AdminController@addNotification']);
	Route::get('viewNotifications', ['as'=>'viewNotifications', 'uses'=>'AdminController@viewNotification']);
	Route::get('deleteNotification/{id}',['as'=>'deleteNotification','uses'=>'AdminController@deleteNotification']);
	Route::get('activateNotification/{id}',['as'=>'activateNotification','uses'=>'AdminController@activateNotification']);
	Route::get('deactivateNotification/{id}',['as'=>'deactivateNotification','uses'=>'AdminController@deactivateNotification']);

	//dept section
	Route::get('showDept',['as'=>'showDept','uses'=>'AdminController@showDept']);
	Route::get('addDept',['as'=>'addDept','uses'=>'AdminController@showDeptForm']);
	Route::post('addDept',['as'=>'addDept','uses'=>'AdminController@addDept']);
	Route::get('deleteDept/{id}', ['as'=>'deleteDept', 'uses'=>'AdminController@deleteDept']);
	Route::get('editDept/{id}',['as'=>'editDept', 'uses'=>'AdminController@showDeptEditForm']);
	Route::post('editDept',['as'=>'updateDept', 'uses'=>'AdminController@editDeptInfo']);

	//batch section
	Route::get('showBatch',['as'=>'showBatch','uses'=>'AdminController@showBatchList']);
	Route::get('addBatch',['as'=>'addBatch','uses'=>'AdminController@showAddBatchForm']);
	Route::post('addBatch',['as'=>'addBatch','uses'=>'AdminController@addBatch']);
	Route::get('deleteBatch/{id}',['as'=>'deleteBatch','uses'=>'AdminController@deleteBatch']);

	//course section
	Route::get('showCourse',['as'=>'showCourse','uses'=>'AdminController@showCourseList']);
	Route::get('addCourse', ['as'=>'addCourse','uses'=>'AdminController@showCourseForm']);
	Route::post('addCourse', ['as'=>'addCourse','uses'=>'AdminController@addCourse']);
	Route::get('deleteCourse/{id}',['as'=>'deleteCourse','uses'=>'AdminController@deleteCourse']);
	Route::get('editCourse/{id}',['as'=>'editCourse','uses'=>'AdminController@showCourseEditForm']);
	Route::post('editCourse',['as'=>'updateCourse', 'uses'=>'AdminController@editCourse']);

	//users section

});

