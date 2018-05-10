@extends('master')
@section('content')
<link rel="stylesheet" title="style" href="source/assets/dest/css/profile2.css">
<div class="container">
	<div id="background" class="space-top-none"></div>
	<div class="main-content">
		<div class="row">

			<div id="background" class="col-sm-3">
				<div class="menu-profile"></div>	
				<div class="member-info">
					<p>Xin chào, Lộc</p>
				</div>
				<ul class="menu-container">
					<li class="item" id="profile">
						<a class="active" href="#">
							<span>Quản lý tài khoản</span>
						</a>
						<ul class="item-container">
							<li id="my-profile" class="sub">
								<a href="#">
									Thông tin Cá Nhân
								</a>
							</li>
							<li id="address-book" class="sub">
								<a href="#">
									Sổ địa chỉ
								</a>
							</li>	
						</ul>
					</li>
					<li class="item" id="orders">
						<a class="active" href="#">
							<span>Đơn hàng của tôi</span>
						</a>
						
						
					</li>
				</ul>

			</div>
			<div id="background" class="col-sm-1"></div>
			<div id="background" class="col-sm-8">
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
								Lộc Nguyễn
							</div>
							<div class="dashboard-item">
								hamuoibon242@gmail.com
							</div>
							<div class="dashboard-item last">
								<a href="#">Chỉnh sửa</a>
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
								<b>Nguyễn Xuân Lộc</b>
							</div>
							<div class="dashboard-item-address">
								Trần hưng đạo, quận 1 , TP HCM
							</div>
							<div class="dashboard-item-address">
								0163-253-0666
							</div>
							<div class="dashboard-item last">
								<a href="#">Chỉnh sửa</a>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>
	</div>
	

</div>

@endsection