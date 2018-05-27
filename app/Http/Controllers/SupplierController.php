<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\productType;
use App\product;
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

    public function getProduct(){
    	return view('supplier.product');
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
				'txtMoTa' => 'required|min:20|max:1000'
								
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
			]);	
			$Sanpham->name = $request->txtTenSP;
			$Sanpham->id_Type = $request->Loai;
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
					return redirect('supplier/Product/ThemSP')->with('thongbao','Bạn chỉ được chọn file là hình ảnh (.jpg, .png, .jpeg)');
				}
				$nameHinh = $file->getClientOriginalName();
				$TenHinh =  $Sanpham->id."_".$nameHinh."_".str_random(4);
				while(file_exists("Image/".$TenHinh))
				{
					$TenHinh = $Sanpham->id."_".$nameHinh."_".str_random(4);
				}
				
				$file->move("Image",$TenHinh);
				unlink("Image/".$Sanpham->image);
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
				'txtMoTa' => 'required|min:20|max:1000'
								
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
				
				
			]);	
			
			$Sanpham = new product;
			$Sanpham->name = $request->txtTenSP;
			$Sanpham->id_Type = $request->Loai;
			$Sanpham->unit_price = $request->txtGia;
			$Sanpham->new = $request->txtSoLuong;
			$Sanpham->unit = $request->txtDonVi;
			$Sanpham->description = $request->txtMoTa;
			$Sanpham->promotion_price = $request->txtGiamGia;
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
				$TenHinh =  $Sanpham->id."_".$nameHinh."_".str_random(4);
				while(file_exists("Image/".$TenHinh))
				{
					$TenHinh = $Sanpham->id."_".$nameHinh."_".str_random(4);
				}
				$file->move("Image",$TenHinh);
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
	
	public function getThongTinSup(){
		$supplierid = Auth::guard('supplier')->user()->id;
		$InfoSup = supplier::where('id','=',$supplierid)->get();
		return view('supplier.ThongTinSup',['InfoSup'=>$InfoSup]);
	}
	
	
}
