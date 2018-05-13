@extends('account.quanlytaikhoan')
@section('noidung')
<link rel="stylesheet" title="style" type="text/css" href="source/assets/dest/css/addresslist.css">
<div class="menu-title">
	<span style="font-size: 36px">Sổ địa chỉ</span>
</div>

<fieldset style="background: #bdd5fb ; padding: 20px">
	<div class="add-address">
		<a href="#" class="add"><i class="fa fa-plus" style="color: #1a9cb7;font-size: 15px"></i>Thêm địa chỉ mới</a>
	</div>
	<div  class="panel panel-info">

		<div id="address" class="panel-body">
			<p class="name">

				Lộc Nguyễn
				<a href="#" style="float: right;" class="edit-address"> Chỉnh sửa</a>
			</p>
			<p class="address">
				<span>Địa chỉ: </span>
				B

			</p>
			<p class="phone">
				<span>Điện thoại: </span>
				C

			</p>
			<p class="action">
				

			</p>
		</div>
	</div>


</fieldset>




@endsection