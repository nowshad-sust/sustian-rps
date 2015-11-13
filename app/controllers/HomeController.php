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
	public function postContactUs(){
			//Get all the data and store it inside Store Variable
	        $data = Input::all();

	        //Validation rules
	        $rules = array (
	            //'username' => 'required', uncomment if you want to grab this field
	            'email' => 'required|email',  //uncomment if you want to grabhis field
	            'message' => 'required|min:5'
	        );

	        //Validate data
	        $validator = Validator::make ($data, $rules);

	        //If everything is correct than run passes.
	        if ($validator -> passes()){

	        	return Redirect::route('home')->with('success','contact service still under construction.
	        		if you have anything to say please mail us: sustrps@gmail.com');
	           Mail::send('home.add.contactus', $data, function($message) use ($data)
	            {
	                $message->from($data['email'] , $data['username']);
	            });
	            // Redirect to page
	   return Redirect::route('home')
	    ->with('message', 'Your message has been sent. Thank You!');


	            //return View::make('contact');  
	         }else{
	   //return contact form with errors
	            return Redirect::back()
	            				->withErrors($validator)
	            				->withInput();

        }
	}

	public function showHome()
	{
		return View::make('home.home')->with('title','home');
	}

	public function showTest()
	{
		return View::make('home.test')->with('title','test');
	}

	public function showAbout(){
		return View::make('home.about')->with('title','about');
	}

	public function showFeatures(){
		return View::make('home.features')->with('title','features');
	}

	public function showContact(){
		return View::make('home.contact')->with('title','contact');
	}
}
