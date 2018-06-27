<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\productType;
use App\product;
use App\supplier;
use App\billdetail;
use App\bill;
use Auth;
use Hash;
class SupplierController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
     	$this->middleware('auth:supplier');
     }

     public function getIndex(){
          $danggiao = billdetail::where('status','Đang Giao')->count();
          $dagiao = billdetail::where('status','Đã Giao')->count();
          $dahuy = billdetail::where('status','Đã Hủy')->count();
          $dadat = billdetail::where('status','Đang Chờ Xử Lý')->count();
          $sanphams = product::where('supplier_id',Auth::guard('supplier')->user()->id)->get();
          
          $product = product::where('supplier_id',Auth::guard('supplier')->user()->id)->get();
          $billdetail = billdetail::where('id_supplier',Auth::guard('supplier')->user()->id)->get();
          $product_type = productType::all();
      
          
          
          
     	return view('supplier.index',compact('sanphams','billdetail','danggiao','dadat','dahuy','dagiao','product_type')); 	
     }

     public function getDanhSachSP(){
     	$supplierid = Auth::guard('supplier')->user()->id;
     	$Sanpham = product::orderBy('created_at','DESC')->where('supplier_id','=',$supplierid)->get();
          foreach ($Sanpham as $item) {
               if($item->new <=0){
                    $item->active = 0;
                    $item->save();
               }

          }
     	return view('supplier.Product.DanhsachSP',['Sanpham'=>$Sanpham]);
     }

     public function getSuaSP($id){
     	$Sanpham = product::find($id);
     	$LoaiSP = productType::all();
     	return view('supplier.Product.SuaSP',['Sanpham'=>$Sanpham,'LoaiSP'=>$LoaiSP]);
     }
     public function getCheckSl($id,$sl){
          $product = Product::find($id);
          if($sl  <= 0 ){
               $product->active = 0;
          }
     }
     public function postShowHide($id){
          $product = product::find($id);
          if($product->active == 1 ){

               $product->active = 0;
               $product->save();

          }
          else {
                $product->active = 1;
                $product->save();
          }
          
          return redirect()->back();
     }
     public function postSuaSP(Request $request,$id){
     	$Sanpham = product::find($id);
     	$this->validate($request,
     		[
     			'txtTenSP' => 'required|min:2|max:100',
     			'Loai' => 'required',
     			'txtGia' => 'required|numeric',
                    'txtGiamGia' => 'required|numeric|max:'.$request->txtGia,
     			'txtDonVi' => 'required',
     			'txtSoLuong' => 'required',
     			'txtMoTa' => 'required|min:20|max:10000',
     			'sku'=> 'required',	
                    'Hinh'=> 'required',  

     		],
     		[
     			'txtTenSP.required'=>'Bạn chưa nhập tên sản phẩm',
     			'txtTenSP.min'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'txtTenSP.max'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'Loai.required'=>'Bạn chưa chọn loại sản phẩm',
     			'txtGia.required'=>'Bạn chưa nhập giá sản phẩm',
                    'txtGia.numeric'=>'Giá chỉ được nhập số',
                    'txtGiamGia.required'=>'Bạn chưa nhập giá bán của sản phẩm',
                    'txtGiamGia.numeric'=>'Giá bán chỉ được nhập số',
                      'txtGiamGia.max'=>'Giá bán không được lớn hơn giá gốc.',
     			'txtDonVi.required'=>'Bạn chưa nhập đơn vị sản phẩm',
     			'txtSoLuong.required'=>'Bạn chưa nhập số lượng sản phẩm',
                    'txtSoLuong.numeric'=>'Số lượng chỉ được nhập số',
     			'txtMoTa.required'=>'Bạn chưa nhập mô tả cho sản phẩm',
     			'txtMoTa.min'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',
     			'txtMoTa.max'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',		
     		     'Hinh.required' =>   'Vui lòng chọn hình ảnh ',
     			'sku.required' =>	'Vui lòng nhập mã SKU ',
     		]);	
     	$Sanpham->name = $request->txtTenSP;
     	$Sanpham->id_Type = $request->Loai;
     	$Sanpham->SKU = $request->sku;
     	$Sanpham->unit_price = $request->txtGia;
     	$Sanpham->new = $request->txtSoLuong;
     	$Sanpham->unit = $request->txtDonVi;
     	$Sanpham->description = $request->txtMoTa;
     	$Sanpham->promotion_price = $request->txtGiamGia;
     	$Sanpham->updated_at = date('Y-m-d H:i:s');
     	$Sanpham->supplier_id = Auth::guard('supplier')->user()->id;


     	if($request->hasfile('Hinh'))
     	{
     		$file = $request->file('Hinh');
     		$duoi = $file->getClientOriginalExtension();
     		if($duoi != 'jpg' && $duoi != 'png' && $duoi = 'jpeg')
     		{
     			return redirect()->back()->with('thongbao','Bạn chỉ được chọn file là hình ảnh (.jpg, .png, .jpeg)');
     		}
     		$nameHinh = $file->getClientOriginalName();
     		$TenHinh =  $Sanpham->id."_".$nameHinh;
     		while(file_exists("source/image/product/".$TenHinh))
     		{
     			$TenHinh = $Sanpham->id.str_random(4)."_".$nameHinh;
     		}

     		$file->move("source/image/product/",$TenHinh);
     		unlink("source/image/product/".$Sanpham->image);
     		$Sanpham->image = $TenHinh;
     	}
     	$Sanpham->save();
     	return redirect()->back()->with('thongbao','Lưu sửa thành công');
     }

     public function getThemSP(){
     	$LoaiSP = productType::all();
     	return view('supplier.Product.ThemSP',['LoaiSP'=>$LoaiSP]);
     }
     public function postThemSP(Request $request){
     	$this->validate($request,
     		[
     			'txtTenSP' => 'required|min:2|max:100',
     			'Loai' => 'required',
     			'txtGia' => 'required|numeric',
                    'txtGiamGia' => 'required|numeric|max:'.$request->txtGia,
     			'txtDonVi' => 'required',
     			'txtSoLuong' => 'required',
     			'txtMoTa' => 'required|min:20|max:10000',
     			'sku'=> 'required',	
                    'Hinh'=> 'required',     

     		],
     		[
     			'txtTenSP.required'=>'Bạn chưa nhập tên sản phẩm',
     			'txtTenSP.min'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'txtTenSP.max'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'Loai.required'=>'Bạn chưa chọn loại sản phẩm',
     			'txtGia.required'=>'Bạn chưa nhập giá sản phẩm',
                    'txtGia.numeric'=>'Giá chỉ được nhập số',
     			'txtDonVi.required'=>'Bạn chưa nhập đơn vị sản phẩm',
                    'txtGiamGia.required'=>'Bạn chưa nhập giá bán của sản phẩm',
                    'txtGiamGia.numeric'=>'Giá bán chỉ được nhập số',
                      'txtGiamGia.max'=>'Giá bán không được lớn hơn giá gốc.',
     			'txtSoLuong.required'=>'Bạn chưa nhập số lượng sản phẩm',
                    'txtSoLuong.numeric'=>'Số lượng chỉ được nhập số',
     			'txtMoTa.required'=>'Bạn chưa nhập mô tả cho sản phẩm',
     			'txtMoTa.min'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',
     			'txtMoTa.max'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',
                    'Hinh.required' =>   'Vui lòng chọn hình ảnh ',
     			'sku.required' =>	'Vui lòng nhập mã SKU ',

     		]);	

     	$Sanpham = new product;
     	$Sanpham->name = $request->txtTenSP;
     	$Sanpham->id_Type = $request->Loai;
     	$Sanpham->SKU = $request->sku;
     	$Sanpham->unit_price = $request->txtGia;
     	$Sanpham->new = $request->txtSoLuong;
     	$Sanpham->unit = $request->txtDonVi;
     	$Sanpham->description = $request->txtMoTa;
     	$Sanpham->promotion_price =$request->txtGiamGia;
     	$Sanpham->created_at = date('Y-m-d H:i:s');
     	$Sanpham->supplier_id = Auth::guard('supplier')->user()->id;


     	if($request->hasfile('Hinh'))
     	{
     		$file = $request->file('Hinh');
     		$duoi = $file->getClientOriginalExtension();
     		if($duoi != 'jpg' && $duoi != 'png' && $duoi = 'jpeg')
     		{
     			return redirect('supplier/Product/ThemSP')->with('thongbao','Bạn chỉ được chọn file là hình ảnh (.jpg, .png, .jpeg)');
     		}
     		$nameHinh = $file->getClientOriginalName();
				//$date = Carbon::now()->toDateTimeString();
				//$timeformat = $date->format('Y-m-d H:i:s.u');
     		$TenHinh =  $Sanpham->id."_".$nameHinh;
     		while(file_exists("source/image/product/".$TenHinh))
     		{
     			$TenHinh = $Sanpham->id.str_random(4)."_".$nameHinh;
     		}
     		$file->move("source/image/product/",$TenHinh);
     		$Sanpham->image = $TenHinh;
     	}
     	
     	$Sanpham->save();

     	return redirect()->back()->with('thongbao','Bạn đã thêm sản phẩm thành công');

     }

    
     public function getInfo(){
          $product = product::where('supplier_id',Auth::guard('supplier')->user()->id)->get();
          $billdetail = billdetail::where('id_supplier',Auth::guard('supplier')->user()->id)->get();
     	$supplier = supplier::find(Auth::guard('supplier')->user()->id)->first();
     	return view('supplier.Info.thongtingianhang',compact('supplier','billdetail','product'));
     }
     public function getEditInfo(){
     	$supplier = supplier::find(Auth::guard('supplier')->user()->id)->first();
     	return view('supplier.Info.suathongtingianhang',compact('supplier'));
     } public function postEditInfo(Request $request){
     	$this->validate($request,
     		[
     			'name' => 'required|min:2|max:100|alpha_num',
     			'phone' => 'required',
     			'Hinh' =>'dimensions:max_height=100,max_width=200'

     		],
     		[
     			'name.required'=>'Bạn chưa nhập tên chủ sở hữu',
     			'name.min'=>'Tên chủ sở hữu phải có độ dài từ 2 đến 100 ký tự',
     			'name.max'=>'Tên chủ sở hữu phải có độ dài từ 2 đến 100 ký tự',
     			'phone.required'=>'Bạn chưa nhập số điện thoại',
     		
     			// 'Hinh.max_height' => 'Logo có chiều cao tối đa 100px',
     			// 'Hinh.max_width' => 'Logo có chiều rộng tối đã 200px',
                    'name.alpha_num'=>'Tên chỉ được chứa chữ và số',
     			'phone.required'=>'Bạn chưa chọn loại sản phẩm',
     			'Hinh.dimensions' => 'Logo có có kích thước vượt quá 200px x 100px'

     			

     		]);	
     	$supplier = supplier::find(Auth::guard('supplier')->user()->id)->first();
     	$supplier->name = $request->name;
     	$supplier->phone = $request->phone;
     	$supplier->email = $supplier->email;
     	$supplier->shopname = $supplier->shopname;
     	if($request->hasfile('Hinh'))
     	{
     		$file = $request->file('Hinh');
     		$duoi = $file->getClientOriginalExtension();
     		if($duoi != 'jpg' && $duoi != 'png' && $duoi = 'jpeg')
     		{
     			return redirect()->back()->with('thongbao','Bạn chỉ được chọn file là hình ảnh (.jpg, .png, .jpeg)');
     		}
     		$nameHinh = $file->getClientOriginalName();
     		$TenHinh =  $supplier->id."_".$nameHinh;
     		while(file_exists("source/supplierlogo/".$TenHinh))
     		{
     			$TenHinh = $supplier->id.str_random(4)."_".$nameHinh;
     		}
     		if ($supplier->logo !=''){
     			$file->move("source/supplierlogo/",$TenHinh);
     			unlink("source/supplierlogo/".$supplier->logo);
     			$supplier->logo = $TenHinh;
     		}
     		
     			$file->move("source/supplierlogo/",$TenHinh);
     			$supplier->logo = $TenHinh;
     		
     		
     	}
     	else{
     		$supplier->logo = $supplier->logo;
     	}
     	$supplier->save();
     	return view('supplier.Info.thongtingianhang',compact('supplier'));
     }
     public function getThongKeDonHang(){
          
          $bill = billdetail::where('id_supplier',Auth::guard('supplier')->user()->id)->orderBy('created_at', 'decs')->get();

          
          return view('supplier.ThongKe.thongkedonhang',compact('bills','bill'));
     }
     public function getChiTietDonHang($id){
          $bill = bill::find($id);
          $billdetail = billdetail::where([['id_bill',$bill->id],['id_supplier',Auth::guard('supplier')->user()->id]])->get();
          $total =0;
          foreach ($billdetail as $item) {
               $total+=$item->unit_price;
          }
          return view('supplier.ThongKe.chitietdonhang',compact('billdetail','bill','total'));
     }
     public function getEditStatusOrders($id){
          $billdetail = billdetail::find($id);
          return view('supplier.ThongKe.chinhsuadonhang',compact('billdetail'));

     }
     public function postEditStatusOrders(Request $req,$id){

         
          $billdetail = billdetail::find($id);
          $bills = billdetail::where('id_bill',$billdetail->id_bill)->orderBy('updated_at', 'asc')->get();      
          $bill = bill::find($billdetail->id_bill);
          $billdetail->status = $req->status;
          $billdetail->save();
          
          foreach ($bills as $item ) {
               $product = product::find($item->id_product);
               if($item->status == "Đang Giao"){
                    $bill->note = "Đang Giao";
                    $bill->save();
               }
               else {
                    if($item->status == "Đã Giao"){
                         $bill->note = "Đã Giao";
                         $bill->save();
                    }
                    if($item->status == "Đã Hủy"){
                         $bill->note = "Đã Hủy";
                         $bill->save();
                         $product->new = $product->new + $item->quantity;
                         $product->save();
                    }
                    if($item->status == "Đang Chờ Xử Lý"){
                         $bill->note = "Đã Đặt Hàng";
                         $bill->save();
                    }
               }
              
               
          }
          
         
         
          return redirect()->back()->with('thongbao','Thay Đổi Thành Công');

     }
     public function getChangePassword(){
          $supplier = supplier::find(Auth::guard('supplier')->user()->id);
          return view('supplier.Info.changepassword',compact('supplier'));
     }
     public function postChangePassword(Request $req){
          $this->validate($req,
               [
                    'currentpwd'=>'required',
                    'newpwd'=>'required|min:6|max:30|alpha_num',
                    'confirmpwd'=>'required|same:newpwd'

               ],
               [
                    'currentpwd.required'=>'Vui Lòng Nhập mật khẩu hiện tại',
                    'newpwd.required'=>'Vui Lòng Nhập mật khẩu mới',
                    'newpwd.min'=>'Mật khẩu mới phải có độ dài từ 6 - 30 ký tự',
                    'newpwd.max'=>'Mật khẩu mới phải có độ dài từ 6 - 30 ký tự',
                    'newpwd.alpha_num'=>'Mật khẩu mới chỉ được chứa ký tự hoặc số',
                    'confirmpwd.required'=>'Vui Lòng Nhập Vào Ô Nhập lại mật khẩu',
                    'confirmpwd.same'=>'Mật khẩu nhập lại không đúng'

               ]

          );
          $currentpwd = Auth::guard('supplier')->user()->password;
          if(Hash::check($req->currentpwd,$currentpwd)){
               $supplier = supplier::find(Auth::guard('supplier')->user()->id);
               $supplier->password = Hash::make($req->newpwd);
               $supplier->save();
               return redirect()->back()->with('thanhcong','Thay đổi mật khẩu thành công');
          }
          else{
               return redirect()->back()->with('thatbai','Mật khẩu hiện tại không đúng');
          }

         

          
     }
     public function getUpdateQty(Request $req,$id){
          $product = Product::find($id);
          $product->new = $req->qty;
          $product->save();
     }
 }
