<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\productType;
use App\product;
use App\supplier;
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
     	return view('supplier.index'); 	
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
     			'sku'=> 'required|unique:product',	

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
     			'sku.unique' =>	'Mã SKU đã tồn tại',
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
     			'sku'=> 'required|unique:product',	

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
     			'sku.unique' =>	'Mã SKU đã tồn tại',
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
     			'Hinh' =>'required|dimensions:max_height=100,max_width=200'

     		],
     		[
     			'name.required'=>'Bạn chưa nhập tên chủ sở hữu',
     			'name.min'=>'Tên chủ sở hữu phải có độ dài từ 2 đến 100 ký tự',
     			'name.max'=>'Tên chủ sở hữu phải có độ dài từ 2 đến 100 ký tự',
     			'phone.required'=>'Bạn chưa chọn loại sản phẩm',
     			'Hinh.required' => 'Bạn chưa chọn logo',
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
     	$supplier->save();
     	return view('supplier.Info.thongtingianhang',compact('supplier'));
     }

 }
