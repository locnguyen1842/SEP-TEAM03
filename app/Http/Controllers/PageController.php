<?php
namespace App\Http\Controllers;
use App\bill;
use App\billdetail;
use App\Cart;
use App\Slide;
use Illuminate\Http\Request;
use App\Product;
use App\productType;
use Session;
use App\address;
use App\customer;
use Hash;
use Auth;

class PageController extends Controller
{
            //
    public function getIndex(){
              $slide = Slide::all();
            	// return view('pages.trangchu',['slide'->$slide]); 
            	$new_product = Product::latest()->paginate(8); //paginate so san pham tren dong
            	$sanpham_khuyenmai = Product::where('promotion_price','<>','')->inRandomOrder()->paginate(8);
            	
            	return view('pages.trangchu',compact('slide','new_product','sanpham_khuyenmai')); 	// truyen du lieu slide
            }
            public function getLoaiSP($type){
            	$loaisp = productType::all();

            	$loai = productType::where('id',$type)->first();
            	$sp_theoloai = Product::where('id_type',$type)->paginate(9);
            	$count_sp_theoloai = Product::where('id_type',$type)->get();
            	return view('pages.loaisp',compact('sp_theoloai','loaisp','loai','count_sp_theoloai'));
            }

            public function getChiTietSP(Request $request){
            	$new_product = Product::where('new',1)->paginate(4);
              $sp_khuyenmai = Product::where('promotion_price','<>','')->paginate(4);
              $sp = Product::where('id',$request->id)->first();
              $sp_tuongtu = Product::where([['id_type',$sp->id_type],['id','<>',$sp->id],])->paginate(3);	
              return view('pages.chitietsp',compact('sp','sp_tuongtu','sp_khuyenmai','new_product'));
          }
          public function getGioiThieu(){
             return view('pages.gioithieu');
         }

         public function getSearch(Request $request){
             $loaisp = productType::all();
             $product = Product::where('name','like','%'.$request->key.'%')
             ->orWhere('unit_price',$request->key)
             ->paginate(6);
             $count_product = Product::where('name','like','%'.$request->key.'%')
             ->orWhere('unit_price',$request->key)
             ->get();
             return view('pages.search',compact('product','count_product','loaisp'));
         }

         public function getSpMoi(){
             $new_product = Product::where('new',1)->paginate(9);
             $count_product = Product::where('new',1)->get();
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
            $oldCart = Session::has('cart')?Session::get('cart'):null;
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
            $url_tinh = file_get_contents('source/tinh_tp.json');

            $data_tinh = json_decode($url_tinh,true);
            
            return view('auth.register',compact('data_tinh'));

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
            $address->address = $req->address;
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
            $url_quan =file_get_contents('source/quan_huyen.json');
            $data_quan = json_decode($url_quan,true);
            $tinh_id = Input::get('tinh_id');

            return $data_quan->where('parent_code',$tinh_id)->get();


        }
        public function getXa(){
           $url_xa =file_get_contents('source/xa_phuong.json');
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

   }
