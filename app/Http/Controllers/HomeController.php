<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
     public function test()
    {
        $data = [
            'name'=>'Loc',
            'emai'=>'haimuoibon024',
            'password'=>'password',
            
            'phone'=>'01632530666',
            
            
        ];
        $request= new Request($data);
        dd($request->email);
        exit();
    }

}
