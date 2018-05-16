<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminLoginController extends Controller
{
	public function __construct()
    {
      $this->middleware('guest:admin',['except'=>['logout']]);
    }

	public function showLoginForm(){
		return view('auth.adminlogin');
	}
	public function login(Request $request){
		
    	//validate form
		// $this->validate($request,[
		// 	'email'=>'required|email',
		// 	'password'=>'required|min:6|max:30'
		// ]);
  //   	//attempt to log the user in
		if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
			//if successfull
			return redirect()->intended(route('admin'));
		}


    	//if unsuccessfull 
    	return redirect()->back()->withInput($request->only('email','remember'));
	}

	public function logout(){
		Auth::guard('admin')->logout();
		return redirect(route('admin.login'));
	}
}
