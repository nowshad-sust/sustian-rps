<?php

class AuthController extends \BaseController {


    public function login(){
		return View::make('auth.login')
					->with('title', 'Login');
	}

	public function doLogin()
	{
		$rules = array
		(
					'email'    => 'required',
					'password' => 'required'
		);
		$allInput = Input::all();
		$validation = Validator::make($allInput, $rules);

		try{
			$userActivation = User::where('email',$allInput['email'])->with('UserInfo')->first();
			if (!$userActivation->userInfo->activation){
				//return 'please activate';
				$route = route('activationRequest');
				$button =  '<a href="'.$route.'"><h3>Activate</h3></a>';
				return Redirect::back()->with('warning','please activate your account first from your mail
							<h4>OR</h4>'.
							$button);
			}
		}catch (Exception $ex){
			return Redirect::back()->with('warning','you are not registered!');
		}

		if ($validation->fails())
		{

			return Redirect::route('login')
						->withInput()
						->withErrors($validation);
		} else
		{

			$credentials = array
			(
						'email'    => Input::get('email'),
						'password' => Input::get('password')
			);

			if (Auth::attempt($credentials))
			{
				return Redirect::intended('dashboard');
			} else
			{
				return Redirect::route('login')
							->withInput()
							->withErrors('Error in Email Address or Password.');
			}
		}
	}

	public function logout(){
		Auth::logout();
		return Redirect::route('login')
					->with('success',"You are successfully logged out.");
	}

	public function dashboard(){
		if(Entrust::hasRole(Config::get('customConfig.roles.user'))){
			return DashboardController::userDashboard();
		}elseif(Entrust::hasRole(Config::get('customConfig.roles.admin'))){
            return DashboardController::adminDashboard();
		}
	}

	public function changePassword(){
		return View::make('auth.changePassword')
					->with('title',"Change Password");
	}

	public function doChangePassword(){
		$rules =[
			'password'              => 'required|confirmed',
			'password_confirmation' => 'required'
		];
		$data = Input::all();

		$validation = Validator::make($data,$rules);

		if($validation->fails()){
			return Redirect::back()->withErrors($validation)->withInput();
		}else{
			$user = Auth::user();
			$user->password = Hash::make($data['password']);

			if($user->save()){
				Auth::logout();
				return Redirect::route('login')
							->with('success','Your password changed successfully.');
			}else{
				return Redirect::route('dashboard')
							->with('error',"Something went wrong.Please Try again.");
			}
		}
	}



}