<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
