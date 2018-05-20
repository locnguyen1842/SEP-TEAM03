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
	$Sanpham = product::all();
	return view('supplier.Product.DanhsachSP',['Sanpham'=>$Sanpham]);
	}
	
	public function getSuaSP(){
		return view('supplier.Product.SuaSP');
	}
	
	public function postSuaSP(){
		return view('supplier.Product.SuaSP');
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
				'txtMota' => 'required|min:20|max|1000'
								
			],
			[
				'txtTenSP.required'=>'Bạn chưa nhập tên sản phẩm',
				'txtTenSP.min'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
				'txtTenSP.max'=>'Tên sản phẩm phải có độ dài từ 2 đến 100 ký tự',
				'Loai.required'=>'Bạn chưa chọn loại sản phẩm',
				'txtGia.required'=>'Bạn chưa nhập giá sản phẩm',
				'txtDonVi.required'=>'Bạn chưa nhập đơn vị sản phẩm',
				'txtSoLuong.required'=>'Bạn chưa nhập số lượng sản phẩm',
				'txtMota.required'=>'Bạn chưa nhập mô tả cho sản phẩm',
				'txtMota.min'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 1000 ký tự',
				'txtMota.max'=>'Mô tả sản phẩm phải có độ dài từ 20 đến 1000 ký tự',
				
				
			]);	
			
			$Sanpham = new product;
			$Sanpham->name = $request->txtTenSP;
			$Sanpham->id_Type = $request->Loai;
			$Sanpham->unit_price = $request->txtGia;
			$Sanpham->new = $request->txtSoLuong;
			$Sanpham->unit = $request->txtDonVi;
			$Sanpham->promotion_price = $request->txtGiamGia;
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
	
	
}
