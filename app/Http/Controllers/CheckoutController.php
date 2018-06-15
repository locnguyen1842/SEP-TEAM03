<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\address;
use App\tinh_tp;
use App\bill;
use App\billdetail;
use App\product;
use Carbon\Carbon;
use Cart;
class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::guard('customer')->check()){
            if (Cart::instance('default')->count() >0){
                $tinh_tp = tinh_tp::all();
                $address = address::where('id_customer',Auth::guard('customer')->user()->id)->get();
                return view('pages.dat_hang',compact('address','tinh_tp'));
            }
            else {
                return view('pages.chitietgiohang');
            }
            
        }
        else {
            return redirect()->route('dangnhap')->with('thongbao','Bạn Vui Lòng Đăng Nhập Để Thực Hiện Việc Đặt Hàng.Nếu Không Có Tài Khoản Vui Lòng Đăng Ký.');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Cart::instance('default')->count() >0 ){
            $this->validate($request,[
                'rdaddress'=>'required',

            ],
            [
                'rdaddress.required'=>'Vui lòng chọn địa chỉ',

            ]
        );
            $bill = new bill;
            $dateString = Carbon::now()->format('Y-m-d\TH:i:s');

            $billnumber = date('Y', strtotime($dateString)).''.date('m', strtotime($dateString)).''.date('d', strtotime($dateString)).''.date('His', strtotime($dateString)).''.Auth::guard('customer')->user()->id;
           
            $bill->bill_number = $billnumber;
            $bill->id_user = Auth::guard('customer')->user()->id;
            $bill->total = Cart::total();
            $bill->note = 'Đặt Thành Công';
            $bill->address_id = $request->rdaddress;
            $bill->save();
            foreach (Cart::content() as $item) {
                $billdetail = new billdetail;
                $billdetail->id_bill = $bill->id;
                $billdetail->id_product = $item->model->id;
                $billdetail->quantity = $item->qty;
                $billdetail->status = 'Đang Chờ Xử Lý';
               
                $product = product::where('id',$billdetail->id_product)->first();
                if($product->promotion_price > 0){

                     $billdetail->unit_price = $item->model->promotion_price;
                }
                else
                {
                     $billdetail->unit_price = $item->model->unit_price;
                }
                $billdetail->id_supplier = $product->supplier->id;
                $billdetail->save();
            }
            Cart::destroy();
            return redirect()->route('checkout.success');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function checkoutss(){
        return view('account.pages.checkoutss');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
