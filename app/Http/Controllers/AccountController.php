<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\customer;
use App\User;
use App\address;
use Hash;
use Auth;
class AccountController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:customer');
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


	public function getProfile(){
		
		return view('account.pages.thongtinprofile');
		
		
	}

	public function getIndexProfile(){
		
		return view('account.pages.thongtincanhan');
		
		
	}

	public function getEditProfile(){
		
		
		return view('account.pages.chinhsuaprofile');
		
		
	}
	public function postEditProfile(Request $req){
		$this->validate($req,
			[
				'txtName'=>'required',

			],
			[
				'txtName.required'=>'Vui Lòng Nhập Tên',
			]

		);


		$id = Auth::user()->customer()->first()->id;
		$profile = customer::find($id);
		$profile->name = $req->txtName;
		$profile->phone = $req->txtPhone;
		$profile->birth_date  = $req->txtBd;
		$profile->gender = $req->get('Gender',0); //xu ly radio button
		$profile->save();
		return redirect()->route('user.profile.index')->with('thanhcong','Cập nhật tài khoản thành công');;
	}

	public function getChangePassword(){

		
		return view('account.pages.doimatkhau');
		
	}

	public function postChangePassword(Request $req){
		$this->validate($req,
			[
				'txtCurrentPwd'=>'required',
				'txtNewPwd'=>'required|min:6|max:30',
				'txtConfirmPwd'=>'required|same:txtNewPwd'

			],
			[
				'txtCurrentPwd.required'=>'Vui Lòng Nhập mật khẩu hiện tại',
				'txtNewPwd.required'=>'Vui Lòng Nhập mật khẩu mới',
				'txtNewPwd.min'=>'Mật khẩu mới phải có độ dài từ 6 - 30 ký tự',
				'txtNewPwd.max'=>'Mật khẩu mới phải có độ dài từ 6 - 30 ký tự',
				'txtConfirmPwd.required'=>'Vui Lòng Nhập Vào Ô Nhập lại mật khẩu',
				'txtConfirmPwd.same'=>'Mật khẩu nhập lại không đúng',

			]

		);

		$user = User::find(Auth::user()->id);
		$user->password = Hash::make($req->txtNewPwd);
		$user->save();

		return redirect()->back()->with('thanhcong','Thay đổi mật khẩu thành công');

	}

	public function getAddressList(){
		
		return view('account.pages.sodiachi');

	}

	public function getEditAddressList($id){
		

		return view('account.pages.chinhsuadiachi');
		
	}

}

