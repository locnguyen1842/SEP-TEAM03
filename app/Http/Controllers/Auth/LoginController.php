<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
	
	public function ketnoidb()
	{
		$ketnoi['host'] = 'den1.mysql5.gear.host'; //Tên server, nếu dùng hosting free thì cần thay đổi
		$ketnoi['dbname'] = 'dbcloudmarket'; //Đây là tên của Database
		$ketnoi['username'] = 'dbcloudmarket'; //Tên sử dụng Database
		$ketnoi['password'] = 'Team@3';//Mật khẩu của tên sử dụng Database
		@mysql_connect(
			"{$ketnoi['host']}",
			"{$ketnoi['username']}",
			"{$ketnoi['password']}")
		or
			die("Không thể kết nối database");
		@mysql_select_db(
			"{$ketnoi['dbname']}") 
		or
			die("Không thể chọn database");
	}
	//Khai báo sử dụng session
	session_start();
 
	//Khai báo utf-8 để hiển thị được tiếng việt
	header('Content-Type: text/html; charset=UTF-8');
 
	//Xử lý đăng nhập
	if (isset($_POST['dangnhap'])) 
	{
		//Kết nối tới database
		ketnoidb();
		 
		//Lấy dữ liệu nhập vào
		$username = addslashes($_POST['txtEmail']);
		$password = addslashes($_POST['txtPassword']);
		 
		//Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
		if (!$username || !$password) {
			echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		 
		// mã hóa pasword
		$password = md5($password);
		 
		//Kiểm tra tên đăng nhập có tồn tại không
		$query = mysql_query("SELECT email, password FROM customer WHERE email='$username'");
		if (mysql_num_rows($query) == 0) {
			echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		 
		//Lấy mật khẩu trong database ra
		$row = mysql_fetch_array($query);
		 
		//So sánh 2 mật khẩu có trùng khớp hay không
		if ($password != $row['password']) {
			echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		 
		//Lưu tên đăng nhập
		$_SESSION['username'] = $username;
		echo "Xin chào " . $username . ". Bạn đã đăng nhập thành công. <a href='/'>Về trang chủ</a>";
		die();
}
