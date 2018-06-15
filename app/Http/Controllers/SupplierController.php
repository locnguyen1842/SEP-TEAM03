<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\productType;
use App\product;
use App\supplier;
use App\billdetail;
use App\bill;
use Auth;
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
          $sanphams = product::where('supplier_id',Auth::guard('supplier')->user()->id)->get();
         
          $product = product::where('supplier_id',Auth::guard('supplier')->user()->id)->get();
          $billdetail = billdetail::all();
          $slorders = 0;
          foreach ($billdetail as $item) {
               foreach ($product as $key) {
                    if ($item->id_product == $key->id){
                         $slorders++;
                    }
               }
          }
          
          
          
     	return view('supplier.index',compact('sanphams','slorders')); 	
     }

     public function getDanhSachSP(){
     	$supplierid = Auth::guard('supplier')->user()->id;
     	$Sanpham = product::orderBy('id','DESC')->where('supplier_id','=',$supplierid)->get();
     	return view('supplier.Product.DanhsachSP',['Sanpham'=>$Sanpham]);
     }

     public function getSuaSP($id){
     	$Sanpham = product::find($id);
     	$LoaiSP = productType::all();
     	return view('supplier.Product.SuaSP',['Sanpham'=>$Sanpham,'LoaiSP'=>$LoaiSP]);
     }
     public function postShowHide($id){
          $product = product::find($id);
          if($product->active == 1 ){
               $product->active = 0;
          }
          else {
                $product->active = 1;
          }
          $product->save();
          return redirect()->back();
     }
     public function postSuaSP(Request $request,$id){
     	$Sanpham = product::find($id);
     	$this->validate($request,
     		[
     			'txtTenSP' => 'required|min:2|max:100',
     			'Loai' => 'required',
     			'txtGia' => 'required',
     			'txtDonVi' => 'required',
     			'txtSoLuong' => 'required',
     			'txtMoTa' => 'required|min:20|max:1000',
     			'sku'=> 'required',	

     		],
     		[
     			'txtTenSP.required'=>'Bạn chưa nhập tên sản phẩm',
     			'txtTenSP.min'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'txtTenSP.max'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'Loai.required'=>'Bạn chưa chọn loại sản phẩm',
     			'txtGia.required'=>'Bạn chưa nhập giá sản phẩm',
     			'txtDonVi.required'=>'Bạn chưa nhập đơn vị sản phẩm',
     			'txtSoLuong.required'=>'Bạn chưa nhập số lượng sản phẩm',
     			'txtMoTa.required'=>'Bạn chưa nhập mô tả cho sản phẩm',
     			'txtMoTa.min'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',
     			'txtMoTa.max'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',		
     		
     			'sku.required' =>	'Vui lòng nhập mã SKU ',
     		]);	
     	$Sanpham->name = $request->txtTenSP;
     	$Sanpham->id_Type = $request->Loai;
     	$Sanpham->SKU = $request->sku;
     	$Sanpham->unit_price = $request->txtGia;
     	$Sanpham->new = $request->txtSoLuong;
     	$Sanpham->unit = $request->txtDonVi;
     	$Sanpham->description = $request->txtMoTa;
     	$Sanpham->promotion_price = ($Sanpham->unit_price * $request->txtGiamGia ) / 100;
     	$Sanpham->updated_at = date('Y-m-d H:i:s');
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
     	return redirect('supplier/Product/SuaSP/'.$id)->with('thongbao','Lưu sửa thành công');
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
     			'txtGia' => 'required',
     			'txtDonVi' => 'required',
     			'txtSoLuong' => 'required',
     			'txtMoTa' => 'required|min:20|max:1000',
     			'sku'=> 'required',	

     		],
     		[
     			'txtTenSP.required'=>'Bạn chưa nhập tên sản phẩm',
     			'txtTenSP.min'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'txtTenSP.max'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
     			'Loai.required'=>'Bạn chưa chọn loại sản phẩm',
     			'txtGia.required'=>'Bạn chưa nhập giá sản phẩm',
     			'txtDonVi.required'=>'Bạn chưa nhập đơn vị sản phẩm',
     			'txtSoLuong.required'=>'Bạn chưa nhập số lượng sản phẩm',
     			'txtMoTa.required'=>'Bạn chưa nhập mô tả cho sản phẩm',
     			'txtMoTa.min'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',
     			'txtMoTa.max'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 10000 ký tự',

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
     	$Sanpham->promotion_price = ($Sanpham->unit_price * $request->txtGiamGia ) / 100;
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
     	else
     	{
     		$Sanpham->image = "";
     	}
     	$Sanpham->save();

     	return redirect('supplier/Product/ThemSP')->with('thongbao','Bạn đã thêm sản phẩm thành công');

     }

     public function getXoaSP($id)
     {
     	$Sanpham = product::find($id);
     	$Sanpham->delete();
     	return redirect('supplier/Product/DanhsachSP')->with('thongbao','Xóa thành công');
     }

     public function getInfo(){
     	$supplier = supplier::find(Auth::guard('supplier')->user()->id)->first();
     	return view('supplier.Info.thongtingianhang',compact('supplier'));
     }
     public function getEditInfo(){
     	$supplier = supplier::find(Auth::guard('supplier')->user()->id)->first();
     	return view('supplier.Info.suathongtingianhang',compact('supplier'));
     } public function postEditInfo(Request $request){
     	$this->validate($request,
     		[
     			'name' => 'required|min:2|max:100',
     			'phone' => 'required',
     			'Hinh' =>'dimensions:max_height=100,max_width=200'

     		],
     		[
     			'name.required'=>'Bạn chưa nhập tên chủ sở hữu',
     			'name.min'=>'Tên chủ sở hữu phải có độ dài từ 2 đến 100 ký tự',
     			'name.max'=>'Tên chủ sở hữu phải có độ dài từ 2 đến 100 ký tự',
     			'phone.required'=>'Bạn chưa chọn loại sản phẩm',
     		
     			// 'Hinh.max_height' => 'Logo có chiều cao tối đa 100px',
     			// 'Hinh.max_width' => 'Logo có chiều rộng tối đã 200px',
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
          
          $bill = billdetail::where('id_supplier',Auth::guard('supplier')->user()->id)->get();

          
          return view('supplier.ThongKe.thongkedonhang',compact('bills','bill'));
     }
     public function getChiTietDonHang($id){
          $bill = bill::find($id);
          $billdetail = billdetail::where([['id_bill',$bill->id],['id_supplier',Auth::guard('supplier')->user()->id]])->get();
          return view('supplier.ThongKe.chitietdonhang',compact('billdetail','bill'));
     }
     public function getEditStatusOrders($id){
          $billdetail = billdetail::find($id);
          return view('supplier.ThongKe.chinhsuadonhang',compact('billdetail'));

     }
     public function postEditStatusOrders(Request $req,$id){

         
          $billdetail = billdetail::find($id);
          $bills = billdetail::where('id_bill',$billdetail->id_bill)->get();
          $bill = bill::find($billdetail->id_bill);
          $billdetail->status = $req->status;
          $billdetail->save();
          foreach ($bills as $item ) {
               if($item->status == "Đang Giao"){
                    $bills->note = "Đang Giao";
               }
               else {
                    $bill->note = "Đặt Thành Công";
               }
               if ($item->status == "Đã Hủy"){
                    $bill->note = "Đã Hủy";
               }
               else{
                    $bill->note = "Đặt Thành Công";
               }
               if ($item->status == "Đã Giao"){
                    $bill->note = "Đã Giao";
               }
               else{
                    $bill->note = "Đặt Thành Công";
               }
               if ($item->status == "Đang Chờ Xử Lý"){
                    $bill->note = "Đang Chờ Xử Lý";
               }
               else{
                    $bill->note = "Đặt Thành Công";
               }
          }
          $bill->save();
          return redirect()->back()->with('thongbao','Thay Đổi Thành Công');

     }
 }
