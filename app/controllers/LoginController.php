<?php

class LoginController extends BaseController{

	public function getIndex(){
		return View::make('main.loginpage');
	}

	public function postIndex(){
		$email = Input::get('login-email');
		$password = Input::get('login-password');
		if(Auth::attempt(array('username' => $email, 'password' => $password))){
			return Redirect::intended('main.mainpage');
		}else{
			return View::make('main.loginpage');
		}
    }
}

