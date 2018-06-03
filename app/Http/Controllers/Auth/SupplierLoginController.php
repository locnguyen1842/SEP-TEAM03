<?php

namespace App\Http\Controllers\Auth;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierLoginController extends Controller
{
	public function __construct()
    {
      $this->middleware('guest:supplier',['except'=>['logout']]);
    }

	public function showLoginForm(){
		return view('auth.supplierlogin');
	}
	public function login(Request $request){
		
    	//validate form
		// $this->validate($request,[
		// 	'email'=>'required|email',
		// 	'password'=>'required|min:6|max:30'
		// ]);
  //   	//attempt to log the user in
		if (Auth::guard('supplier')->attempt(['email'=>$request->email,'password'=>$request->password])){
			//if successfull
			return redirect()->route('supplier');
		}


    	//if unsuccessfull 
    	return redirect()->back()->with(['flag'=>'danger','thongbao'=>'Email hoặc Mật Khẩu Không Đúng']);
	}

	public function logout(){
		Auth::guard('supplier')->logout();
		return redirect(route('supplier.login'));
	}
}
