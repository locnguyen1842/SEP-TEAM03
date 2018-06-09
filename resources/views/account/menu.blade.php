
<div class="menu-profile"></div>	
<div class="member-info">
	<p>Xin chào, Lộc</p>
</div>
<ul class="menu-container">
	<li class="item" id="profile">
		<a class="active" href="{{ route('user.quanly') }}">
			<span>Quản lý tài khoản</span>
		</a>
		<ul class="item-container">
			<li id="my-profile" class="sub">
				<a href="{{ route('user.profile.index') }}">
					Thông tin Cá Nhân
				</a>
			</li>
			<li id="address-book" class="sub">
				<a href="{{ route('user.address') }}">
					Sổ địa chỉ
				</a>
			</li>	
		</ul>
	</li>
	<li class="item" id="orders">
		<a class="active" href="{{ route('user.orders') }}">
			<span>Đơn hàng của tôi</span>
		</a>
		
		
	</li>
</ul>
