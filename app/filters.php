<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login')->with('warning','you are not logged in');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check())
		return Redirect::to('/')->with('warning','you are already logged in!');
});

Route::filter('activation', function()
{
	if (Auth::user()->userInfo->activation == false){
		//logout if logged in
		if(Auth::user()){
			Auth::logout();
		}
		return Redirect::route('activationRequest')->with('warning','please activate your account first');
	}
});

Route::filter('approval', function()
{
	if (Auth::user()->userInfo->approval == false){
	
		return View::make('user.notApproved')
					->with('title', 'Not Approved')
					->with('warning','please wait for the approval of your account by the representative of your batch.');
	}
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

Route::filter('admin',function(){
	if(! Entrust::hasRole(Config::get('customConfig.roles.admin'))){
		return Redirect::back();
	}
});

Route::filter('manager',function(){
	if(! Entrust::hasRole(Config::get('customConfig.roles.manager'))){
		return Redirect::back();
	}
});

Route::filter('user',function(){
	if(! Entrust::hasRole(Config::get('customConfig.roles.user'))){
		return Redirect::back();
	}
});
