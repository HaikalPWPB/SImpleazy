<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\User;

class AuthController extends Controller
{
    

	public function login(Request $request){

		$email = $request->email;
		$password = $request->password;

		$logged = User::where('email',$email)->first();
		if ($logged) {
			if (Hash::check($password,$logged->password)) {
					Session::put('username',$logged->username);
					Session::put('email',$logged->email);
					Session::put('login',TRUE);

					return session::get('login');
				}else{
					return 500;
				}	
		}

	}

	public function register(Request $request){

		$validated = $request->validate([
			'username' => 'required|min:3|max:20',
			'email' => 'required|email|unique:users',
			'password' => 'required'
		]);

		$registered = new User;
		$registered->username = $request->username;
		$registered->email = $request->email;
		$registered->password = bcrypt($request->password);
		$registered->save();

		return $registered;
	}

}
