<?php
namespace App\Http\Controllers;
use App\bill;
use App\billdetail;
use Cart;
use App\Slide;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Input;
use App\productType;
use Session;
use App\address;
use App\aboutUs;
use App\customer;
use App\tinh_tp;
use App\xa_phuong;
use App\quan_huyen;
use Hash;
use Auth;

class PageController extends Controller
{
            //
            public function getIndex(){
              $slideA = Slide::where('index',1)->first();
              $slide = Slide::where('index',1)->get()->forget(0);
              	// return view('pages.trangchu',['slide'->$slide]); 
                
              	$new_product = Product::latest()->where([['unlock',1],['active',1],['new','>',0]])->paginate(8); //paginate so san pham tren dong
              	$sanpham_khuyenmai = Product::where([['promotion_price','<>',''],['active',1],['new','>',0],['unlock',1]])->inRandomOrder()->paginate(8);
              	
              	return view('pages.trangchu',compact('slide','new_product','sanpham_khuyenmai','slideA')); 	// truyen du lieu slide
              }
            public function getLoaiSP($type){
            	$loaisp = productType::all();

            	$loai = productType::where('id',$type)->first();
            	$sp_theoloai = Product::where([['id_type',$type],['active',1],['new','>',0],['unlock',1]])->paginate(9);
            	$count_sp_theoloai = Product::where('id_type',$type)->get();
            	return view('pages.loaisp',compact('sp_theoloai','loaisp','loai','count_sp_theoloai'));
            }

            public function getChiTietSP(Request $request){
            	$new_product = Product::latest()->where('active',1)->paginate(4);
              $sp_khuyenmai = Product::where([['promotion_price','<>',''],['active',1],['new','>',0],['unlock',1]])->paginate(4);
              $sp = Product::where([['id',$request->id],['active',1],['new','>',0],['unlock',1]])->first();
              $sp_tuongtu = Product::where([['id_type',$sp->id_type],['id','<>',$sp->id],['active',1],['new','>',0],['unlock',1]])->paginate(3);	
              return view('pages.chitietsp',compact('sp','sp_tuongtu','sp_khuyenmai','new_product'));
            }
            public function getGioiThieu(){

              $ab = aboutUs::find(1);
              return view('pages.gioithieu',compact('ab'));
            }

            public function getSearch(Request $request){
              $key = $request->key;
             $loaisp = productType::all();
             $product = Product::where([['name','like','%'.$request->key.'%'],['active',1],['new','>',0],['unlock',1]])
             ->orWhere('unit_price',$request->key)
             ->paginate(6);
             $count_product = Product::where([['name','like','%'.$request->key.'%'],['active',1],['new','>',0],['unlock',1]])
             ->orWhere('unit_price',$request->key)
             ->get();
             return view('pages.search',compact('product','count_product','loaisp','key'));
           }

           public function getSpMoi(){
             $new_product = Product::latest()->where([['active',1],['new','>',0],['unlock',1]])->paginate(9);
             $count_product = Product::where([['active',1],['new','>',0],['unlock',1]])->get();
             $loaisp = productType::all();
             return view('pages.sanphammoi',compact('new_product','count_product','loaisp'));
           }
           public function getSpKhuyenMai(){
             $sanpham_khuyenmai = Product::where('promotion_price','<>','')->paginate(9);
             $count_product = Product::where('promotion_price','<>','')->get();
             $loaisp = productType::all();
             return view('pages.sanphamgiamgia',compact('sanpham_khuyenmai','count_product','loaisp'));
           }

           public function getAddtoCart(Request $req, $id)
           {
            $product = Product::find($id);
            $oldCart = Session('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->add($product,$id);
            $req->session()->put('cart',$cart);
            return redirect()->back();
          }
          public function getDelItemCart($id)
          {
            $oldCart = Session::hass('cart')?Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $cart->removeItem($id);
            if(count($cart->items)>0)
            {
              Session::put('cart',$cart);

            }
            else
            {
              Session::forget('cart');
            }
            return redirect()->back();

          }

          public function getCheckout(){
            if(Session::has('cart')){
              $oldCart = Session::get('cart');
              $cart = new Cart($oldCart);
              return view('pages.dat_hang',['product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,
                'totalQty'=>$cart->totalQty]);
            }
            else
            {
              return view('pages.dat_hang');
            }
          }
          public function postCheckout(Request $req){
            $cart = Session::get('cart');

            $customer = new Customer;
            $customer->name = $req->name;
            $customer->gender = $req->gender;
            $customer->email = $req->email;
            $customer->address = $req->address;
            $customer->phone = $req->phone;
            $customer->note = $req->notes;
            $customer->save();

            $bill = new Bill;
            $bill->id_customer = $customer->id;
            $bill->date_order = date('Y-m-d');
            $bill->total = $cart->totalPrice;
            $bill->payment = $req->payment_method;
            $bill->note = $req->notes;
            $bill->save();

            foreach ($cart->items as $key => $value) {
              $bill_detail = new BillDetail;
              $bill_detail->id_bill = $bill->id;
              $bill_detail->id_product = $key;
              $bill_detail->quantity = $value['qty'];
              $bill_detail->unit_price = ($value['price']/$value['qty']);
              $bill_detail->save();
            }
            Session::forget('cart');
            return redirect()->back()->with('thongbao','Đặt hàng thành công');

          }
          public function getSignUp(){

            if(Auth::guard('customer')->check()){
              return redirect()->route('trangchu');
            }
            $tinh_tp = tinh_tp::all();

            
            return view('auth.register',compact('tinh_tp'));

          }

          public function postSignUp(Request $req){
            $this->validate($req,
              [
                'email'=>'required|unique:customers,email',
                'password'=>'required|min:6|max:30',
                'repassword'=>'required|same:password'
              ],
              [
                'email.required'=>'Vui Lòng Nhập Email',
                'email.email'=> 'Không đúng định dạng Email',
                'email.unique'=>'Email đã tồn tại',
                'password.required'=>'Vui Lòng Nhập Password',
                'password.min'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
                'password.max'=>'Mật khẩu phải có độ dài từ 6 - 30 ký tự',
                'repassword.required'=>'Vui Lòng Nhập Vào Ô Xác Nhận Mật Khẩu',
                'repassword.same'=>'Xác nhận mật khẩu không đúng'

              ]

            );
                //get json


            $address = new address;
            $customer = new Customer;
            $address->name = $req->name;
            $address->phone = $req->phone;
            $address->addressde = $req->address;
            $xa_phuong = xa_phuong::where('code',$req->xa_phuong)->first();
            $address->mavung = $xa_phuong->path_with_type;
            $customer->password = Hash::make($req->password);
            $customer->name =  $req->name;
            $customer->email =  $req->email;
            $customer->phone = $req->phone;
            $customer->save();
            $address->id_customer= $customer->id;
            $address->save();





            return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');


          }
          public function getQuan(){
            $tinh_tp_id = Input::get('parent_code');
            $quan_huyen = quan_huyen::where('parent_code', '=', $tinh_tp_id)->get();
            return response()->json($quan_huyen);

          }
          public function getXa(){
            $quan_huyen_id = Input::get('parent_code');
            $xa_phuong = xa_phuong::where('parent_code', '=', $quan_huyen_id)->get();
            return response()->json($xa_phuong);
          }
          public function getCartDetails(){
            if(Session::has('cart')){
              $oldCart = Session::get('cart');
              $cart = new Cart($oldCart);
              return view('pages.chitietgiohang',['product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,
                'totalQty'=>$cart->totalQty]);
            }
            else
            {
              return view('pages.chitietgiohang');
            }
          }

          public function muahang(){

          }




        }
