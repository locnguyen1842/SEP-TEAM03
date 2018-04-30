<?php

namespace App\Http\Controllers;
use App\Slide;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function getIndex(){
    	$slide = Slide::all();
    	// return view('pages.trangchu',['slide'->$slide]); 
    	return view('pages.trangchu',compact('slide')); 	// truyen du lieu slide
    }
    public function getLoaiSP(){
    	return view('pages.loaisp');
    }

    public function getChiTietSP(){
    	return view('pages.chitietsp');
    }
      public function getGioiThieu(){
    	return view('pages.gioithieu');
    }
}
