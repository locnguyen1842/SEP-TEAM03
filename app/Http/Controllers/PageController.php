<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;
use App\Product;
class PageController extends Controller
{
    //
    public function getIndex(){
    	$slide = Slide::all();
    	// return view('pages.trangchu',['slide'->$slide]); 
    	$new_product = Product::where('new',1)->paginate(4); //paginate so san pham tren dong
    	$sanpham_khuyenmai = Product::where('promotion_price','<>','')->paginate(4);
    	
    	return view('pages.trangchu',compact('slide','new_product','sanpham_khuyenmai')); 	// truyen du lieu slide
    }
    public function getLoaiSP($type){
    	$sp_theoloai = Product::where('id_type',$type)->get();
    	return view('pages.loaisp',compact('sp_theoloai'));
    }

    public function getChiTietSP(){
    	return view('pages.chitietsp');
    }
      public function getGioiThieu(){
    	return view('pages.gioithieu');
    }
}
