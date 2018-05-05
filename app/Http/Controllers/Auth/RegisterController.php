<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
	
	/**
	kết nối database
	*/
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
	
	function redirect($path){
    header("Location: $path");
	}
	
	// Nếu không phải là sự kiện đăng ký thì không xử lý
    if (!isset($_POST['txtEmail'])){
        die('');
    }
	
	//Nhúng file kết nối với database
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
	ketnoidb();
	
	//Khai báo utf-8 để hiển thị được tiếng việt
    header('Content-Type: text/html; charset=UTF-8');
          
    //Lấy dữ liệu từ file dangky.php
    $email      = addslashes($_POST['txtEmail']);
    $password   = addslashes($_POST['txtPassword']);
    $fullname   = addslashes($_POST['txtName']);
	$Diachi   	= addslashes($_POST['txtDiachi']);	
    $SDT   		= addslashes($_POST['txtSDT']);
          
    //Kiểm tra người dùng đã nhập liệu đầy đủ chưa
    if (!$password || !$email || !$fullname || !$Diachi || !$SDT)
    {
        echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
        // Mã khóa mật khẩu
        $password = md5($password);
          
    //Kiểm tra email có đúng định dạng hay không
    if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email))
    {
        echo "Email này không hợp lệ. Vui long nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
    //Kiểm tra email đã có người dùng chưa
    if (mysql_num_rows(mysql_query("SELECT email FROM customer WHERE email='$email'")) > 0)
    {
        echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
          
    //Lưu thông tin thành viên vào bảng
    @$addcustomer = mysql_query("
        INSERT INTO customer (
			name,
            email,
			password,
            SDT,
        )
        VALUE (
            '{$password}',
            '{$email}',
            '{$fullname}',
            '{$SDT}',
        )
    ");
	@$addaddress = mysql_query("
        INSERT INTO address (
			address,
        )
        VALUE (
            '{$Diachi}',
        )
    ");
                          
    //Thông báo quá trình lưu
    if ($addmember)
        echo "Quá trình đăng ký thành công. <a href='/'>Về trang chủ</a>";
    else
        echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='dangky.php'>Thử lại</a>";
	
	header("location:index.php?page=login");
}
