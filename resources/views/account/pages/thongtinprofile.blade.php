@extends('account.quanlytaikhoan')
@section('noidung')
<link rel="stylesheet" title="style" href="source/assets/dest/css/profile2.css">
<div class="menu-title">
	<span style="font-size: 36px">Quản lý tài khoản</span>
</div>
<div class="user-container">
	<div class="dashboard">
		<div id="dashboard" class="col-sm-5">
			<div class="dashboard-title">
				Thông tin cá nhân
			</div>
			<div class="dashboard-item">
				{{ Auth::guard('customer')->user()->name }}
			</div>
			<div class="dashboard-item">
				{{ Auth::user()->email }}
			</div>
			<div class="dashboard-item last">
				<a href="{{ route('user.profile.edit') }}">Chỉnh sửa</a>
			</div>
		</div>
		<div id="dashboard" class="col-sm-6">
			<div class="dashboard-title">
				Sổ địa chỉ
			</div>
			<div class="dashboard-item-address-default">
				địa chỉ nhận hàng
			</div>
			<div class="dashboard-item-address-name">
				<b>{{ $address->name }}</b>
			</div>
			<div class="dashboard-item-address">
				{{ $address->addressde }} , {{ $address->mavung }}
			</div>

			<div class="dashboard-item-address">
				{{ $address->phone }}
			</div>
			<div class="dashboard-item last">
				<a href="{{ route('user.address') }}">Xem sổ địa chỉ</a>
			</div>
		</div>
	</div>

</div>

@endsection

