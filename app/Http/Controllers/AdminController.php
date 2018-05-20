<?php

namespace App\Http\Controllers;
use Auth;
use App\Supplier;
use App\product;
use Illuminate\Http\Request;
use Hash;
class AdminController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function getIndex(){
    	return view('admin.index'); 	
    }

    public function getListSupplier(){
        $suppliers = Supplier::all();
    	return view('admin.listsupplier',compact('suppliers'));
    }

    public function getSupplierCreate(){
        
        return view('admin.taotaikhoansupplier');
    }

    public function postSupplierCreate(Request $req){
         $this->validate($req,
            [
                'email'=>'required|unique:suppliers,email',
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
        $supplier = new Supplier;
        $supplier->email = $req->email;
        $supplier->password = Hash::make($req->password);
        $supplier->save();

        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }

    public function getSupplierDelete($id){
        $supplier = Supplier::find($id);
        $supplier->delete();
        return redirect()->route('admin.listsupplier');
    }
	

}
