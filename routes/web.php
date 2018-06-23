<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('index',[

	'as'=>'trangchu',
	'uses'=>'PageController@getIndex'

]);
//tinh , quan , xa route

Route::get('/json-quan','PageController@getQuan')->name('jsonquan');
Route::get('/json-xa','PageController@getXa')->name('jsonxa');

//home route
Route::get('loai-san-pham/{type?}',[
	'as'=>'loaisp',
	'uses'=>'PageController@getLoaiSP'
]);

Route::get('chi-tiet-san-pham/{id?}',[
	'as'=>'chitietsp',
	'uses'=>'PageController@getChiTietSP'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);


Route::get('san-pham-khuyen-mai',[
	'as'=>'spkhuyenmai',
	'uses'=>'PageController@getSpKhuyenMai'
]);
Route::get('cart',[
	'as'=>'cart.index',
	'uses'=>'CartController@index'
]);
Route::get('cart-update/{id}',[
	'as'=>'cart.update',
	'uses'=>'CartController@update'
]);
Route::delete('cart-delete/{id}',[
	'as'=>'cart.destroy',
	'uses'=>'CartController@destroy'
]);

Route::post('cart',[
	'as'=>'cart.store',
	'uses'=>'CartController@store'
]);


Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);


Route::get('san-pham-moi',[
	'as'=>'spmoi',
	'uses'=>'PageController@getSpMoi'
]);

Route::get('san-pham-khuyen-mai',[
	'as'=>'spkhuyenmai',
	'uses'=>'PageController@getSpKhuyenMai'
]);
//checkout route
	Route::get('checkout','CheckoutController@index')->name('checkout.index');
	Route::get('checkoutss','CheckoutController@checkoutss')->name('checkout.success');
	Route::post('checkout','CheckoutController@store')->name('checkout.store');

//user login route
Route::get('dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'Auth\CustomerLoginController@showLoginForm'
]);

Route::post('dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'Auth\CustomerLoginController@login'
]);


Route::get('dang-ky',[
	'as'=>'dangky',
	'uses'=>'PageController@getSignUp'
]);

Route::post('dang-ky',[
	'as'=>'dangky',
	'uses'=>'PageController@postSignUp'
]);

Route::get('dang-xuat',[
	'as'=>'dangxuat',
	'uses'=>'Auth\CustomerLoginController@logout'
]);

//forgot password route
Route::get('password/reset',[
	'as'=>'password.request',
	'uses'=>'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::get('password/reset/{token}',[
	'as'=>'password.reset',
	'uses'=>'Auth\ResetPasswordController@showResetForm'
]);
Route::post('password/reset',[
	'as'=>'password.rs',
	'uses'=>'Auth\ResetPasswordController@reset'
]);
Route::post('password/email',[
	'as'=>'password.email',
	'uses'=>'Auth\ForgotPasswordController@sendResetLinkEmail'
]);

//admin route
Route::group(['prefix'=>'admin'],function(){
	Route::get('login',[
		'as'=>'admin.login',
		'uses'=>'Auth\AdminLoginController@showLoginForm'
	]);
	Route::post('login',[
		'as'=>'admin.login.submit',
		'uses'=>'Auth\AdminLoginController@login'
	]);
	Route::get('logout',[
		'as'=>'admin.logout',
		'uses'=>'Auth\AdminLoginController@logout'
	]);
	Route::get('index',[
		'as'=>'admin',
		'uses'=>'AdminController@getIndex'
	]);
	//about us
		Route::get('aboutUs-index',[
		'as'=>'admin.aboutus.index',
		'uses'=>'AdminController@getIndexAboutUs'
		]);
		Route::get('aboutUs-edit',[
		'as'=>'admin.aboutus.edit',
		'uses'=>'AdminController@getEditAboutUs'
		]);
		Route::post('aboutUs-edit',[
		'as'=>'admin.aboutus.edit',
		'uses'=>'AdminController@postEditAboutUs'
		]);
	//slider
		Route::get('slider-list',[
		'as'=>'admin.slider.index',
		'uses'=>'AdminController@getListSlider'
		]);
		Route::get('slider-showhide/{id}',[
		'as'=>'admin.slider.showhide',
		'uses'=>'AdminController@postShowHideSlider'
		]);
		Route::get('slider-delete/{id}',[
			'as'=>'admin.slider.delete',
			'uses'=>'AdminController@getDeleteSlider'
		]);
		Route::get('slider-edit/{id}',[
			'as'=>'admin.slider.edit',
			'uses'=>'AdminController@getEditSlider'
		]);
		Route::post('slider-edit/{id}',[
			'as'=>'admin.slider.edit',
			'uses'=>'AdminController@postEditSlider'
		]);
		Route::get('slider-add',[
			'as'=>'admin.slider.add',
			'uses'=>'AdminController@getAddSlider'
		]);
		Route::post('slider-add',[
			'as'=>'admin.slider.add',
			'uses'=>'AdminController@postAddSlider'
		]);
	//category
		Route::get('category-list',[
			'as'=>'admin.category.index',
			'uses'=>'AdminController@getListCategory'
		]);
		Route::get('category-delete/{id}',[
			'as'=>'admin.category.delete',
			'uses'=>'AdminController@getDeleteCategory'
		]);
		Route::get('category-edit/{id}',[
			'as'=>'admin.category.edit',
			'uses'=>'AdminController@getEditCategory'
		]);
		Route::post('category-edit/{id}',[
			'as'=>'admin.category.edit',
			'uses'=>'AdminController@postEditCategory'
		]);
		Route::get('category-add',[
			'as'=>'admin.category.add',
			'uses'=>'AdminController@getAddCategory'
		]);
		Route::post('category-add',[
			'as'=>'admin.category.add',
			'uses'=>'AdminController@postAddCategory'
		]);
	//supplier	
		Route::get('supplier-list',[
			'as'=>'admin.listsupplier',
			'uses'=>'AdminController@getListSupplier'
		]);
		Route::get('supplier-create',[
			'as'=>'admin.createsupplier',
			'uses'=>'AdminController@getSupplierCreate'
		]);
		Route::post('supplier-create',[
			'as'=>'admin.createsupplier',
			'uses'=>'AdminController@postSupplierCreate'
		]);
		Route::get('supplier-delete/{id?}',[
			'as'=>'admin.deletesupplier',
			'uses'=>'AdminController@getSupplierDelete'
		]);
		Route::get('supplier-edit/{id}',[
			'as'=>'admin.editsupplier',
			'uses'=>'AdminController@getEditSupplier'
		]);
		Route::post('supplier-edit/{id}',[
			'as'=>'admin.editsupplier',
			'uses'=>'AdminController@postEditSupplier'
		]);
	//thong ke
		Route::get('product-list',[
			'as'=>'admin.listproduct',
			'uses'=>'AdminController@getListProduct'
		]);
		Route::get('order-list',[
			'as'=>'admin.listorder',
			'uses'=>'AdminController@getListOrder'
		]);
		Route::get('order-detail/{id}',[
			'as'=>'admin.orderdetail',
			'uses'=>'AdminController@getDetailOrder'
		]);
		Route::get('product-delete/{id}',[
			'as'=>'admin.deleteproduct',
			'uses'=>'AdminController@getDeleteProduct'
		]);
		Route::get('product-lock/{id}',[
			'as'=>'admin.product.lock',
			'uses'=>'AdminController@getLockProduct'
		]);
	//admin resetpwd
		Route::post('password/email',[
			'as'=>'admin.password.email',
			'uses'=>'Auth\AdminForgotPasswordController@sendResetLinkEmail'
		]);
		Route::get('password/reset',[
			'as'=>'admin.password.request',
			'uses'=>'Auth\AdminForgotPasswordController@showLinkRequestForm'
		]);
		Route::post('password/reset',[
			'as'=>'admin.password.rs',
			'uses'=>'Auth\AdminResetPasswordController@reset'
		]);
		Route::get('password/reset/{token}',[
			'as'=>'admin.password.reset',
			'uses'=>'Auth\AdminResetPasswordController@showResetForm'
		]);



});
//supplier route
Route::group(['prefix'=>'supplier'],function(){
	Route::get('login',[
		'as'=>'supplier.login',
		'uses'=>'Auth\SupplierLoginController@showLoginForm'
	]);
	Route::post('login',[
		'as'=>'supplier.login.submit',
		'uses'=>'Auth\SupplierLoginController@login'
	]);
	Route::get('logout',[
		'as'=>'supplier.logout',
		'uses'=>'Auth\SupplierLoginController@logout'
	]);
	Route::get('/',[
		'as'=>'supplier.checksl',
		'uses'=>'SupplierController@getCheckSl'
	]);
	Route::get('index',[
		'as'=>'supplier',
		'uses'=>'SupplierController@getIndex'
	]);
	Route::get('change-password',[
		'as'=>'supplier.password.edit',
		'uses'=>'SupplierController@getChangePassword'
	]);
	Route::post('change-password',[
		'as'=>'supplier.password.edit',
		'uses'=>'SupplierController@postChangePassword'
	]);
	Route::get('info',[
		'as'=>'supplier.info',
		'uses'=>'SupplierController@getInfo'
	]);
	Route::get('info/edit',[
		'as'=>'supplier.info.edit',
		'uses'=>'SupplierController@getEditInfo'
	]);
	Route::post('info/edit',[
		'as'=>'supplier.info.edit',
		'uses'=>'SupplierController@postEditInfo'
	]);
		//supplier reset pwd
	Route::post('password/email',[
		'as'=>'supplier.password.email',
		'uses'=>'Auth\SupplierForgotPasswordController@sendResetLinkEmail'
	]);
	Route::get('password/reset',[
		'as'=>'supplier.password.request',
		'uses'=>'Auth\SupplierForgotPasswordController@showLinkRequestForm'
	]);
	Route::post('password/reset',[
		'as'=>'supplier.password.rs',
		'uses'=>'Auth\SupplierResetPasswordController@reset'
	]);
	Route::get('password/reset/{token}',[
		'as'=>'supplier.password.reset',
		'uses'=>'Auth\SupplierResetPasswordController@showResetForm'
	]);


	Route::group(['prefix'=>'Product'],function(){
			//supplier/Product/ThemSP
		Route::get('DanhsachSP','SupplierController@getDanhSachSP')->name('supplier.product.index');

		Route::get('SuaSP/{id}','SupplierController@getSuaSP')->name('supplier.product.edit');
		Route::post('SuaSP/{id}','SupplierController@postSuaSP')->name('supplier.product.edit');
		Route::get('Update-Quantity/{id}','SupplierController@getUpdateQty')->name('supplier.product.qty');
		Route::get('ThemSP','SupplierController@getThemSP')->name('supplier.product.add');
		Route::post('ThemSP','SupplierController@postThemSP')->name('supplier.product.add');
		Route::get('ShowHide/{id}','SupplierController@postShowHide')->name('supplier.product.showhide');
		Route::get('XoaSP/{id}','SupplierController@getXoaSP')->name('supplier.product.delete');
	});
	Route::group(['prefix'=>'thongke'],function(){
			//supplier/Info
		Route::get('thong-ke-don-hang','SupplierController@getThongKeDonHang')->name('supplier.thongkedonhang.index');

		Route::get('chi-tiet-don-hang/{id}','SupplierController@getChiTietDonHang')->name('supplier.chitietdonhang.index');
		Route::get('trang-thai-don-hang/{id}','SupplierController@getEditStatusOrders')->name('supplier.thongkedonhang.edit');
		Route::post('trang-thai-don-hang/{id}','SupplierController@postEditStatusOrders')->name('supplier.thongkedonhang.edit');
	});
});
//user route
Route::group(['prefix'=>'user'],function(){
	Route::get('quan-ly',[
		'as'=>'user.quanly',
		'uses'=>'AccountController@getProfile'
	]);
	Route::group(['prefix'=>'orders'],function(){
		Route::get('index',[
			'as'=>'user.orders.index',
			'uses'=>'AccountController@getOrders'
		]);

		Route::get('detail/{id}',[
			'as'=>'user.orders.detail',
			'uses'=>'AccountController@getOrdersDetail'
		]);
	});

		//address route
	Route::group(['prefix'=>'address'],function(){

		Route::get('add',[
			'as'=>'user.address.add',
			'uses'=>'AccountController@getAddAddressList'
		]);

		Route::get('',[
			'as'=>'user.address',
			'uses'=>'AccountController@getAddressList'
		]);
		Route::get('edit/{id}',[
			'as'=>'user.address.edit',
			'uses'=>'AccountController@getEditAddressList'
		]);
		Route::post('edit/{id}',[
			'as'=>'user.address.edit',
			'uses'=>'AccountController@postEditAddressList'
		]);
		Route::post('add',[
			'as'=> 'user.address.add',
			'uses'=>'AccountController@postaddAddressList'
		]);
		Route::get('delete/{id}',[
			'as'=> 'user.address.delete',
			'uses'=>'AccountController@getdelete'
		]);


	});

	//orders user
	Route::group(['prefix'=>'orders'],function(){

		Route::get('/',[
			'as'=>'user.orders',
			'uses'=>'AccountController@getOrders'
		]);

	


	});
	Route::group(['prefix'=>'profile'],function(){

		Route::get('/',[
			'as'=>'user.profile.index',
			'uses'=>'AccountController@getIndexProfile'
		]);

		Route::get('chinh-sua',[
			'as'=>'user.profile.edit',
			'uses'=>'AccountController@getEditProfile'
		]);
		Route::post('chinh-sua',[
			'as'=>'user.profile.edit',
			'uses'=>'AccountController@postEditProfile'
		]);
		Route::get('thay-doi-mat-khau',[
			'as'=>'user.profile.changepassword',
			'uses'=>'AccountController@getChangePassword'
		]);
		Route::post('thay-doi-mat-khau',[
			'as'=>'user.profile.changepassword',
			'uses'=>'AccountController@postChangePassword'
		]);
	});

});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');