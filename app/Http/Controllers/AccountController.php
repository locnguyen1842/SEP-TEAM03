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
	public function getLogin(){
		return view('auth.login');
	}

	public function getSignUp(){
		return view('auth.register');
	}

	public function postSignUp(Request $req){
		$this->validate($req,
			[
				'email'=>'required|unique:users,email',
				'password'=>'required|min:6|max:30',
				'repassword'=>'required|same:password'
			],
			[
				'email.required'=>'Vui Lòng Nhập Email',
				'email.email'=> 'Không đúng định dạng Email',
				'email.unique'=>'Email đã tồn tại',
				'password.required'=>'Vui Lòng Nhập Password',
				'password.min'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
				'password.max'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
				'repassword.required'=>'Vui Lòng Nhập Vào Ô Xác Nhận Mật Khẩu',
				'repassword.same'=>'Xác nhận mật khẩu không đúng'

			]

		);
		$address = new address;
		$customer = new customer;
		$account = new User;
		$account->password = Hash::make($req->password);
		$customer->name =  $req->name;
		$account->email =  $req->email;
		$customer->phone = $req->phone;
		$address->address = $req->address;
		$account->role = "customer";
		$address->save();
		$customer->save();
		$customer->address()->attach($address);
		$account->save();
		$account->customer()->attach($customer);


		
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
		if (Auth::check()){
			return view('account.pages.thongtinprofile');
		}
		else
		{
			
			return redirect()->route('dangnhap');
		}
		
	}

	public function getIndexProfile(){
		if (Auth::check()){
			return view('account.pages.thongtincanhan');
		}
		else
		{
			
			return redirect()->route('dangnhap');
		}
		
	}

	public function getEditProfile(){
		
		if (Auth::check()){
			return view('account.pages.chinhsuaprofile');
		}
		else
		{
			
			return redirect()->route('dangnhap');
		}
		
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

		if (Auth::check()){
			return view('account.pages.doimatkhau');
		}
		else
		{
			
			return redirect()->route('dangnhap');
		}
		
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


	public function getForgotPwd(){
		return view('pages.quenmatkhau');
	}

	public function postForgotPwd(Request $req){
		$email = $req->txtEmail;
		$checkEmail = User::where('email','$email')->get();
		if(count($email)==0){
			return redirect()->back()->with('error','Email không tồn tại trong hệ thống');
		}
		else{
			$to = $email;
			$subject="Phục hồi mật khẩu - CloudBooth";
			$message= "<a href=''>link</a>";
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
			$headers .= 'From: <webmaster@example.com>' . "\r\n";
			$headers .= 'Cc: myboss@example.com' . "\r\n";

			mail($to,$subject,$message,$headers);
		}
	}

}

