<?php

namespace App\Http\Controllers;
use Auth;
use App\Supplier;
use App\product;
use App\bill;
use App\billdetail;
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
        $product = product::all();
        $bill = bill::all();
    	return view('admin.index',compact('product','bill')); 	
    }

    public function getListSupplier(){
        $suppliers = Supplier::all();
    	return view('admin.listsupplier',compact('suppliers'));
    }

    public function getSupplierCreate(){
        
        return view('admin.taotaikhoansupplier');
    }
    public function getListProduct(){
        $Sanpham = product::all();
        return view ('admin.thongkesanpham',compact('Sanpham'));
    }
    public function getDeleteProduct($id){
        $product = product::find($id);
        $product->delete();
        return redirect()->back();
    }
    public function getListOrder(){
       
        $bill = bill::all();
       
        return view('admin.thongkedonhang',compact('bill'));
    }
    public function getDetailOrder($id){

        $bill = bill::find($id);
        $billdetail = billdetail::where('id_bill',$bill->id)->get();
        // $product = product::where('id',$billdetail->id_product)->get();
        return view('admin.chitietdonhang',compact('bill','billdetail'));
    }

    public function postSupplierCreate(Request $req){
         $this->validate($req,
            [
                'email'=>'required|unique:suppliers,email',
                'shopname'=>'required|unique:suppliers',
                'password'=>'required|min:6|max:30',
                'repassword'=>'required|same:password',
            ],
            [
                'email.required'=>'Vui Lòng Nhập Email',
                'email.email'=> 'Không đúng định dạng Email',
                'email.unique'=>'Email đã tồn tại',
                'shopname.required'=>'Vui Lòng Nhập Tên Gian Hàng',
                'shopname.unique'=>'Tên Gian Hàng Đã Tồn Tại',
                'password.required'=>'Vui Lòng Nhập Password',
                'password.min'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
                'password.max'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
                'repassword.required'=>'Vui Lòng Nhập Vào Ô Xác Nhận Mật Khẩu',
                'repassword.same'=>'Xác nhận mật khẩu không đúng'

            ]

        );
        $supplier = new Supplier;
        $supplier->email = $req->email;
        $supplier->shopname = $req->shopname;
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
