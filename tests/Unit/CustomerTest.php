<?php

namespace Tests\Unit;
use App\Customer;
use Tests\TestCase;
use App\Address;
use App\Http\Controllers\HomeController;
use Hash;
use Cart;
use Session;
use App\product;
use App\Http\Controllers\Auth\CustomerLoginController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Auth;
use App\bill;
use Illuminate\Http\Request;

class CustomerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    protected $customer;
    public function setUp(){
        parent::setUp();
        
    }
   public function sign_up_customers(){


        $user = Customer::latest()->first();
        $user->address()->delete();
        $user->delete();
           $response= $this->post('dang-ky', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'address' =>'tran hung dao',
            'tinh_tp' =>'89',
            'quan_huyen' =>'883',
            'xa_phuong' =>'30463',
            'phone' =>'01632530666',
            'repassword' =>'secret',
        ]);

       

       $this->assertEquals('John Doe', $user->name);
       $this->assertEquals('john@example.com', $user->email);
       $this->assertEquals('01632530666', $user->phone);
       $this->assertTrue(Hash::check('secret', $user->password));
    
   }
   public function test_login_customer(){
        // $user = Customer::latest()->first();//lấy user mới thêm vào
        // $user->address()->delete(); // xóa bảng có chứa khóa ngoại của user
        // $user->delete(); // xoa user mới thêm vào

        $dangnhap= $this->post('/dang-nhap', [
           
            'email' => 'haimuoibon024@gmail.com',
            'password' => '123456',
            
        ]); //đăng nhập tài khoản customer 
       $this->assertTrue(Auth::guard('customer')->check());
       

   }
    public function test_add_address(){

       Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']); //đăng nhập tài khoản customer 
        $user = Customer::where('email','haimuoibon024@gmail.com')->first();
       
         $themDiaChi= $this->post('/user/address/add', [

            'name' => 'John Doe',                       
            'address' =>'tran hung dao',
            'tinh_tp' =>'89',//Tỉnh an giang
            'quan_huyen' =>'883',//Huyện Châu Phú,
            'xa_phuong' =>'30463',//Thị Trấn Cái Dầu
            'phone' =>'01632530666',
            
        ]); // thêm địa chỉ mới cho user vừa mới tạo

         $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
          $this->assertEquals('John Doe', $user->address()->latest()->first()->name);
         $this->assertEquals('tran hung dao', $user->address()->latest()->first()->addressde);
         $this->assertEquals('Thị trấn Cái Dầu, Huyện Châu Phú, Tỉnh An Giang', $user->address()->latest()->first()->mavung);
         $this->assertEquals('01632530666', $user->address()->latest()->first()->phone);
   }
   public function test_edit_address(){

        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập tài khoản customer 
        $user = Customer::where('email','haimuoibon024@gmail.com')->first();
        $idaddress=$user->address()->latest()->first()->id; // lấy id địa chỉ mới nhất.
        $suaDiaChi= $this->post('/user/address/edit/'.$idaddress, [

            'name' => 'Lộc Nguyễn',                       
            'address' =>'Trần Xuân Soạn',
            'tinh_tp' =>'79',//TP Hồ CHí Minh
            'quan_huyen' =>'778',//Quận 7,
            'xa_phuong' =>'27475',//Phường Tân Hưng
            'phone' =>'01632530333',
            
        ]); // sửa địa chỉ mới nhất cho user đang đăng nhập
        $address = Address::find($idaddress);
         $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
         $this->assertEquals('Lộc Nguyễn', $address->name);
         $this->assertEquals('Trần Xuân Soạn', $address->addressde);
         $this->assertEquals('Phường Tân Hưng, Quận 7, Thành phố Hồ Chí Minh', $address->mavung);
         $this->assertEquals('01632530333', $address->phone);
   }
  
   public function test_change_password_with_correct_current_password(){
        $user = Customer::where('email','john@example.com')->first();
        $user->password=Hash::make('secret');
        $user->save(); // reset lại mật khẩu sau khi test
        Auth::guard('customer')->attempt(['email'=>'john@example.com','password'=>'secret']);//đăng nhập
        
        $doiPassword= $this->post('/user/profile/thay-doi-mat-khau/', [

            'txtCurrentPwd' => 'secret',                       
            'txtNewPwd' =>'matkhaumoi',
            'txtConfirmPwd' =>'matkhaumoi',
            
            
        ]); // thay đổi mật khẩu của tài khoản đang đăng nhập
        // var_dump($user->password);
        // ob_flush();
        $usercurrent = Customer::where('email','john@example.com')->first();
         $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
         $this->assertTrue(Hash::check('matkhaumoi', $usercurrent->password));// so sánh với password đã được đổi hay chưa
         
   }
   public function test_change_password_with_incorrect_current_password(){
        $user = Customer::where('email','john@example.com')->first();
        $user->password=Hash::make('secret');
        $user->save(); // reset lại mật khẩu sau khi test
        Auth::guard('customer')->attempt(['email'=>'john@example.com','password'=>'secret']);//đăng nhập
        
        $doiPassword= $this->post('/user/profile/thay-doi-mat-khau/', [

            'txtCurrentPwd' => 'secret1',                       
            'txtNewPwd' =>'matkhaumoi',
            'txtConfirmPwd' =>'matkhaumoi',
            
            
        ]); // thay đổi mật khẩu của tài khoản đang đăng nhập
        // var_dump($user->password);
        // ob_flush();
        $usercurrent = Customer::where('email','john@example.com')->first();
         $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
         $this->assertFalse(Hash::check('matkhaumoi', $usercurrent->password));//nếu nhập sai mật khẩu hiện tại thì kiểm tra trong db  sẽ không thay đổi mật khẩu mới.(assertFalse)
         
   }
   public function test_change_info(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        
        $doiPassword= $this->post('/user/profile/chinh-sua', [

            'txtName' => 'Lộc Nguyễn',                       
            'txtBd' =>'1997-04-30',//yyyy-mm-dd
            'txtPhone' =>'01632530000',
            'Gender' =>'Nam',
            
            
        ]); // thay đổi mật khẩu của tài khoản đang đăng nhập
        $user = Customer::where('email','haimuoibon024@gmail.com')->first();
        $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
        $this->assertEquals('Lộc Nguyễn', $user->name);
        $this->assertEquals('1997-04-30', $user->birth_date);
        $this->assertEquals('Nam', $user->gender);
        $this->assertEquals('01632530000', $user->phone);
         
   }
    public function test_get_profile_index(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        
        $response = $this->get('/user/quan-ly');
        $response->assertStatus(200);
         
   }
   public function test_get_info_index(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        
        $response = $this->get('/user/profile');
        $response->assertStatus(200);
         
   }
   public function test_get_edit_profile(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        
        $response = $this->get('/user/profile/chinh-sua');
        $response->assertStatus(200);
         
   }
   public function test_get_change_password(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        
        $response = $this->get('/user/profile/thay-doi-mat-khau');
        $response->assertStatus(200);
         
   }
   public function test_get_address_list(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        
        $response = $this->get('/user/address');
        $response->assertStatus(200);
         
   }
   public function test_get_add_address(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        
        $response = $this->get('/user/address/add');
        $response->assertStatus(200);
         
   }
   public function test_get_edit_address(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $user = Customer::where('email','haimuoibon024@gmail.com')->first();
        $address = $user->address()->latest()->first(); //lấy địa chỉ mới của user đang nhập nhập
        $response = $this->get('/user/address/edit/'.$address->id);
        $response->assertStatus(200);
         
   }
    public function test_get_orders(){
        
        
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $response = $this->get('/user/orders');
        $response->assertStatus(200);
         
   }
   public function test_add_a_item_to_cart(){
        
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $bill = Bill::where('id_user',Auth::guard('customer')->user()->id);
        $product = product::find(17);//Sản phẩm dưa pepino
        $price =0;
        if($product->promotion_price > 0){
            $price = $product->promotion_price;
        }
        else{
            $price = $product->unit_price;
        }
        $response = $this->post('/cart',[
            'id'=>$product->id,//Dưa pepino
            'name'=> $product->name,
            'price'=>$price,
        ]);
        $itemInCart = Cart::content()->first();
        $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
        $this->assertEquals($product->id, $itemInCart->model->id);
        $this->assertEquals($product->name, $itemInCart->model->name);
        $this->assertEquals($price, Cart::subtotal());
         
   }
   public function test_checkout_item_has_promotion_price(){
        
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $user = customer::where('email','haimuoibon024@gmail.com')->first(); //lấy thông tin user đăng nhập
        $address = $user->address()->latest()->first(); // lấy địa chỉ của user
        $bill = Bill::where('id_user',Auth::guard('customer')->user()->id);
        $product = product::find(17);//Sản phẩm dưa pepino
        $price = $product->promotion_price;
        Cart::add($product->id,$product->name,1,$price)
            ->associate('App\product');// thêm 1 sản phẩm vào giỏ hàng (productId,productName,quantity,price)
        $itemInCart = Cart::content()->first();
        $priceInCart = Cart::total();
        $response = $this->post('/checkout',[
            'rdaddress'=>$address->id,
            
        ]);
        $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
        $billcheckout = Bill::where('address_id',$address->id)->latest()->first();//lấy bill có địa địa chỉ vừa đặt
        $this->assertEquals($priceInCart, $billcheckout->total);//so sánh tổng số tiền của bill so với cart
        $this->assertEquals($user->id, $billcheckout->id_user);//so sánh id user đặt hàng so với id user trong bảng bill

   }
   public function test_checkout_item_hasnt_promotion_price(){
        
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $user = customer::where('email','haimuoibon024@gmail.com')->first(); //lấy thông tin user đăng nhập
        $address = $user->address()->latest()->first(); // lấy địa chỉ của user
        $bill = Bill::where('id_user',Auth::guard('customer')->user()->id);
        $product = product::find(24);//Sản phẩm chuối xiêm (không có giá khuyến mãi)
        $price = $product->unit_price;
        Cart::add($product->id,$product->name,1,$price)
            ->associate('App\product');// thêm 1 sản phẩm vào giỏ hàng (productId,productName,quantity,price)
        $itemInCart = Cart::content()->first();
        $priceInCart = Cart::total();
        $response = $this->post('/checkout',[
            'rdaddress'=>$address->id,
            
        ]);
        $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
        $billcheckout = Bill::where('address_id',$address->id)->latest()->first();//lấy bill có địa địa chỉ vừa đặt
        $this->assertEquals($priceInCart, $billcheckout->total);//so sánh tổng số tiền của bill so với cart
        $this->assertEquals($user->id, $billcheckout->id_user);//so sánh id user đặt hàng so với id user trong bảng bill

   }
   public function test_checkout_with_hasnt_item_in_cart(){
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $user = customer::where('email','haimuoibon024@gmail.com')->first(); //lấy thông tin user đăng nhập
        $address = $user->address()->latest()->first(); // lấy địa chỉ của user
        $response = $this->post('/checkout',[
            'rdaddress'=>$address->id,
            
        ]);
        $this->assertTrue(Auth::guard('customer')->check());
        $this->assertTrue(Cart::instance('default')->count()== 0);//kiểm không có sản phẩm nào trong cart .
        

   }
   public function test_get_orders_detail(){
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $bill = Bill::where('id_user',Auth::guard('customer')->user()->id)->latest()->first();
        $response = $this->get('/user/orders/detail/'.$bill->id);
        $response->assertStatus(200);
         
   }
   public function test_get_cart_detail_when_logged_in(){
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $response = $this->get('/cart');
        $this->assertTrue(Auth::guard('customer')->check());
        $response->assertStatus(200);//kiểm tra trạng thái của trang web, 200 là trả về view
         
   }
    public function test_get_cart_detail_when_hasnt_login(){
        $response = $this->get('/cart');
        $this->assertFalse(Auth::guard('customer')->check());//kiểm tra không có user nào đang đăng nhập
        $response->assertStatus(200);//kiểm tra trạng thái của trang web, 200 là trả về view
        
   }
   public function test_get_success_checkout_page(){
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);
        $response = $this->get('/checkoutss');
        $this->assertTrue(Auth::guard('customer')->check());//kiểm tra không có user nào đang đăng nhập
        $response->assertStatus(200);//kiểm tra trạng thái của trang web, 200 là trả về view
        
   }
   public function test_delete_a_item_in_cart(){
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $user = customer::where('email','haimuoibon024@gmail.com')->first(); //lấy thông tin user đăng nhập
        $address = $user->address()->latest()->first(); // lấy địa chỉ của user
        $bill = Bill::where('id_user',Auth::guard('customer')->user()->id);
        $product = product::find(24);//Sản phẩm chuối xiêm (không có giá khuyến mãi)
        $price = $product->unit_price;
        $itemInCart= Cart::add($product->id,$product->name,1,$price)
            ->associate('App\product');// thêm 1 sản phẩm vào giỏ hàng (productId,productName,quantity,price)
        
        $response = $this->delete('/cart-delete/'.$itemInCart->rowId);
        $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
        $this->assertTrue(Cart::instance('default')->count()== 0);//kiểm không có sản phẩm nào trong cart .
        

   }
   public function test_get_checkout_page_with_has_item_in_cart(){
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $product = product::find(24);//Sản phẩm chuối xiêm (không có giá khuyến mãi)
        $price = $product->unit_price;
        $itemInCart= Cart::add($product->id,$product->name,1,$price)
            ->associate('App\product');// thêm 1 sản phẩm vào giỏ hàng (productId,productName,quantity,price)
        
        $response = $this->get('/checkout');
        $this->assertTrue(Auth::guard('customer')->check());        //kiểm tra đăng nhập
        $this->assertTrue(Cart::instance('default')->count()> 0);//kiểm không có sản phẩm nào trong cart .
        $response->assertStatus(200);//kiểm tra trạng thái của trang web, 200 là trả về view
        

   }
   public function test_get_checkout_page_with_hasnt_item_in_cart(){
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $response = $this->get('/checkout');
        $this->assertTrue(Auth::guard('customer')->check());
        $response->assertStatus(200);//kiểm tra trạng thái của trang web, 200 là trả về view
        $this->assertTrue(Cart::instance('default')->count()== 0);//kiểm không có sản phẩm nào trong cart .
        

   }
    
   public function test_get_checkout_page_when_hasnt_loggin(){
        Cart::destroy();
        $product = product::find(24);//Sản phẩm chuối xiêm (không có giá khuyến mãi)
        $price = $product->unit_price;
        $itemInCart= Cart::add($product->id,$product->name,1,$price)
            ->associate('App\product');// thêm 1 sản phẩm vào giỏ hàng (productId,productName,quantity,price)
        $response = $this->get('/checkout');
        $this->assertFalse(Auth::guard('customer')->check());
        $response->assertStatus(302);//kiểm tra trạng thái của trang web, 302 là chuyển hướng đến trang khác.
        
        

   }
   public function test_add_duplicate_item_to_cart(){
        Cart::destroy();//xóa tất cả sản phẩm trong giỏs
        Auth::guard('customer')->attempt(['email'=>'haimuoibon024@gmail.com','password'=>'123456']);//đăng nhập
        $bill = Bill::where('id_user',Auth::guard('customer')->user()->id);
        $product = product::find(17);//Sản phẩm dưa pepino
        $price =0;
        if($product->promotion_price > 0){
            $price = $product->promotion_price;
        }
        else{
            $price = $product->unit_price;
        }
        $item1 = $this->post('/cart',[
            'id'=>$product->id,//Dưa pepino
            'name'=> $product->name,
            'price'=>$price,
        ]);
        $itemDuplicate = $this->post('/cart',[
            'id'=>$product->id,//Dưa pepino
            'name'=> $product->name,
            'price'=>$price,
        ]);
        $itemInCart = Cart::content()->first();
        $this->assertTrue(Auth::guard('customer')->check());//kiểm tra đăng nhập
        $this->assertTrue(Cart::instance('default')->count()== 1);//thêm trùng 1 sản phẩm vào giỏ hàng thì giỏ hàng chỉ hiển thị 1 sản phẩm
        
        

   }
   
   
   
   
}
