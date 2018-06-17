<?php

namespace App\Http\Controllers;
use Auth;
use App\Supplier;
use App\product;
use App\slide;
use App\bill;
use App\aboutUs;
use App\productType;
use App\billdetail;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
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
                'shopname'=>'required|unique:suppliers|min:4|max:30|alpha_num',
                'password'=>'required|min:6|max:30|alpha_num',
                'repassword'=>'required|same:password',
            ],
            [
                'email.required'=>'Vui Lòng Nhập Email',
                'email.email'=> 'Không đúng định dạng Email',
                'email.unique'=>'Email đã tồn tại',
                'shopname.required'=>'Vui Lòng Nhập Tên Gian Hàng',
                'shopname.unique'=>'Tên Gian Hàng Đã Tồn Tại',
                'shopname.min'=>'Tên Gian Hàng phải có độ dài từ 4 - 30 ký tự',
                'shopname.max'=>'Tên Gian Hàng phải có độ dài từ 4 - 30 ký tự',
                'shopname.alpha_num'=>'Tên Gian Hàng chỉ được chưa chữ hoặc số',
                'password.required'=>'Vui Lòng Nhập Password',
                'password.alpha_num'=>'Mật khẩu chỉ được chưa chữ hoặc số',
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
    public function getListCategory(){
        $category = productType::all();
        return view('admin.listcategory',compact('category'));
    }
    public function getAddCategory(){
        return view('admin.addcategory');
    }
    public function postAddCategory(Request $req){
        $this->validate($req,
            [
                'name'=>'required|unique:type_product|min:4|max:50',
                'mota'=>'required|min:4|max:50',
                
            ],
            [
                'name.required'=>'Vui lòng nhập tên loại sản phẩm',               
                'name.unique'=>'Loại sản phẩm này đã tồn tại',
                'name.min'=>'Tên loại sản phẩm phải có độ dài từ 4-50 ký tự',
                'name.max'=>'Tên loại sản phẩm phải có độ dài từ 4-50 ký tự',
                'mota.required'=> 'Vui lòng nhập mô tả loại sản phẩm',
                'mota.min'=>'Mô tả sản phẩm phải có độ dài từ 4-50 ký tự',
                'mota.max'=>'Mô tả sản phẩm phải có độ dài từ 4-50 ký tự',
                

            ]

        );
        $category = new productType;
        $category->name = $req->name;
        $category->desciption = $req->mota;
        $category->save();
         return redirect()->back()->with('thanhcong','Thêm loại sản phẩm thành công');
    }
    public function getEditCategory($id){
        $category = productType::find($id);
        return view('admin.editcategory',compact('category'));
    }
    public function postEditCategory(Request $req,$id){
         $this->validate($req,
           [
                'name'=>'required|unique:type_product|min:4|max:50',
                'mota'=>'required|min:4|max:50',
                
            ],
            [
                'name.required'=>'Vui lòng nhập tên loại sản phẩm',               
                'name.unique'=>'Loại sản phẩm này đã tồn tại',
                'name.min'=>'Tên loại sản phẩm phải có độ dài từ 4-50 ký tự',
                'name.max'=>'Tên loại sản phẩm phải có độ dài từ 4-50 ký tự',
                'mota.required'=> 'Vui lòng nhập mô tả loại sản phẩm',
                'mota.min'=>'Mô tả sản phẩm phải có độ dài từ 4-50 ký tự',
                'mota.max'=>'Mô tả sản phẩm phải có độ dài từ 4-50 ký tự',
                

            ]

        );
        $category = productType::find($id);
        $category->name = $req->name;
        $category->desciption = $req->mota;
        $category->save();
        return redirect()->back()->with('thanhcong','Sửa loại sản phẩm thành công');

    }
    public function getDeleteCategory($id){
        $category = productType::find($id);
        $category->delete();
        return redirect()->back();

    }
    public function getListSlider(){
        $slider = slide::all();
        return view('admin.listslider',compact('slider'));

    }
     public function postShowHideSlider($id){
        $slider = slide::find($id);
        if($slider->index == 0 ){
            $slider->index = 1;
            
        }
        else{
            $slider->index = 0;
             
        }
        
        $slider->save();
        return redirect()->back();
        
    }

    public function getAddSlider(){
       
        return view('admin.addslider');

        
    }
    public function postAddSlider(Request $req){
        $this->validate($req,
            [
                'image'=>'required|image|max:2048',
                'mota'=>'required|min:4|max:50',
                
            ],
            [
                'image.required'=>'Vui lòng chọn hình ảnh',   
                'image.image'=>'Vui lòng chọn file có định dạng hình ảnh',  
                'mota.required'=> 'Vui lòng nhập mô tả slide',
                'mota.min'=>'Mô tả sản phẩm phải có độ dài từ 4-50 ký tự',
                'mota.max'=>'Mô tả sản phẩm phải có độ dài từ 4-50 ký tự',
                

            ]

        );
        $slider = new slide;
        $slider->description = $req->mota;
        $slider->index = 0;
            
         
        if($req->hasFile('image'))
        {
            
            $image = $req->file('image');
            $duoi = $image->getClientOriginalExtension();
            $nameimage = 'slide'.((slide::all()->last()->id)+1).'.'.$duoi;
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(900, 400);
            $image_resize->save(public_path('/source/image/slide/' .$nameimage));
            
           
            $slider->image = $nameimage;
        }
        
        $slider->save();
        return redirect()->back()->with('thanhcong','Thêm slider thành công');
        
    }
    public function getDeleteSlider($id){
        $slider = slide::find($id);
        $slider->delete();
        return redirect()->back();
        
    }
    public function getIndexAboutUs(){
        $ab = aboutUs::find(1);
        return view('admin.indexaboutus',compact('ab'));

    }
     public function getEditAboutUs(){
        $ab = aboutUs::find(1);
        return view('admin.editaboutus',compact('ab'));

    }
     public function postEditAboutUs(Request $req){
        $this->validate($req,
            [
                'content'=>'required|min:30|max:10000',
              
                
            ],
            [
                
                'content.required'=> 'Vui lòng nhập mô tả slide',
                'content.min'=>'Mô tả sản phẩm phải có độ dài từ 30-10000 ký tự',
                'content.max'=>'Mô tả sản phẩm phải có độ dài từ 30-10000 ký tự',
                

            ]

        );
        $ab = aboutUs::find(1);
        $ab->content = $req->content;
        $ab->save();
        return redirect()->back()->with('thanhcong','Chỉnh sửa thành công');
    }
	

}
