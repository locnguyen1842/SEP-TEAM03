<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerLoginController extends Controller
{
	public function __construct()
    {
      $this->middleware('guest:customer',['except'=>['logout']]);
    }

	public function showLoginForm(){
		return view('auth.login');
	}
	public function login(Request $request){
		
    	//validate form
		// $this->validate($request,[
		// 	'email'=>'required|email',
		// 	'password'=>'required|min:6|max:30'
		// ]);
  //   	//attempt to log the user in
		if (Auth::guard('customer')->attempt(['email'=>$request->email,'password'=>$request->password])){
			//if successfull
			return redirect()->intended(route('trangchu'));
		}


    	//if unsuccessfull 
    	return redirect()->back()->with(['flag'=>'danger','thongbao'=>'Email hoặc Mật Khẩu Không Đúng']);
	}

	public function logout(){
		Auth::guard('customer')->logout();
		return redirect(route('trangchu'));
	}
}
