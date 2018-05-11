<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function getIndex(){
    	return view('pages.trangchu',compact('slide','new_product','sanpham_khuyenmai')); 	// truyen du lieu slide
    }
}
