<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use Hash;
use Auth;
class AccountController extends Controller
{
	public function getLogin(){
		return view('pages.dangnhap');
	}

	public function getSignUp(){
		return view('pages.dangky');
	}

	public function postSignUp(Request $req){
		$this->validate($req,
			[
				'txtEmail'=>'required|unique:customer,email',
				'txtPassword'=>'required|min:6|max:30',
				'txtrePassword'=>'required|same:txtPassword'
			],
			[
				'txtEmail.required'=>'Vui Lòng Nhập Email',
				'txtEmail.email'=> 'Không đúng định dạng Email',
				'txtEmail.unique'=>'Email đã tồn tại',
				'txtPassword.required'=>'Vui Lòng Nhập Password',
				'txtPassword.min'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
				'txtPassword.max'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
				'txtrePassword.required'=>'Vui Lòng Nhập Vào Ô Xác Nhận Mật Khẩu',
				'txtrePassword.same'=>'Xác nhận mật khẩu không đúng'

			]

		);
		$customer =  new customer();
		$customer->name = $req->txtName;
		$customer->email = $req->txtEmail;
		$customer->password = Hash::make($req->txtPassword);
		$customer->phone = $req->txtSDT;
		$customer->save();
		return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
		

	}

	public function postLogin(Request $req){
		$this->validate($req,
			[
				'txtEmail'=>'required|email',
				'txtPassword'=>'required'
			],
			[
				'txtEmail.required'=>'Vui Lòng Nhập Email',
				'txtEmail.email'=>'Email Không Đúng Định Dạng',
				'txtPassword.required'=>'Vui Lòng Điền Password'
			]

		);
		$credentials = array('email'=>$req->txtEmail,'password'=>$req->txtPassword);
		if(Auth::attempt($credentials)){
			return redirect()->route('trangchu')->with(['flag'=>'success','thongbao'=>'Đăng Nhập Thành Công']);
		}
		else{
			return redirect()->back()->with(['flag'=>'danger','thongbao'=>'Email hoặc Mật Khẩu Không Đúng']);
		}


	}

	public function getLogOut(){
		Auth::logout();
		return redirect()->route('trangchu');
	}

	public function getProfile(){
		return view('account.quanlytaikhoan');
	}

}
