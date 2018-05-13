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

Route::get('loai-san-pham/{type?}',[
	'as'=>'loaisp',
	'uses'=>'PageController@getLoaiSP'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsp',
	'uses'=>'PageController@getChiTietSP'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
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
Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddtoCart'
]);


Route::get('dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'Auth\LoginController@showLoginForm'
]);

Route::post('dang-nhap',[
	'as'=>'dangnhap',
	'uses'=>'Auth\LoginController@login'
]);


Route::get('dang-ky',[
	'as'=>'dangky',
	'uses'=>'AccountController@getSignUp'
]);

Route::post('dang-ky',[
	'as'=>'dangky',
	'uses'=>'AccountController@postSignUp'
]);

Route::get('dang-xuat',[
	'as'=>'dangxuat',
	'uses'=>'Auth\LoginController@logout'
]);
//forgot password route
Route::get('reset',[
	'as'=>'pwdforgot',
	'uses'=>'Auth\ForgotPasswordController@showLinkRequestForm'
]);
Route::get('password/reset/{token?}',[
	'as'=>'pwdreset',
	'uses'=>'Auth\ResetPasswordController@showResetForm'
]);
Route::post('reset',[
	'as'=>'pwdreset',
	'uses'=>'Auth\ResetPasswordController@reset'
]);
Route::post('email',[
	'as'=>'pwdemail',
	'uses'=>'Auth\ForgotPasswordController@sendResetLinkEmail'
]);
Route::post('email',[
	'as'=>'pwdemail',
	'uses'=>'Auth\ForgotPasswordController@sendResetLinkEmail'
]);


Route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);
//admin route

	Route::get('admin/index',[
		'as'=>'admin',
		'uses'=>'AdminController@getIndex'
	]);
	Route::get('admin/product',[
		'as'=>'product',
		'uses'=>'AdminController@getProduct'
	]);


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

		Route::get('index',[
			'as'=>'user.orders.detail',
			'uses'=>'AccountController@getOrdersDetail'
		]);
	});

	Route::group(['prefix'=>'profile'],function(){

		Route::get('index',[
			'as'=>'user.profile.index',
			'uses'=>'AccountController@getIndexProfile'
		]);

		Route::get('so-dia-chi',[
			'as'=>'user.profile.addresslist',
			'uses'=>'AccountController@getAddressList'
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
