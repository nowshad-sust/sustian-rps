<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showHome()
	{
		return View::make('home.home');
	}

	public function showTest()
	{
		return View::make('home.test');
	}

	public function showAbout(){
		return View::make('home.about');
	}

	public function showFeatures(){
		return View::make('home.features');
	}

	public function showContact(){
		return View::make('home.contact');
	}
}
