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

