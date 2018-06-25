@extends('account.quanlytaikhoan')
@section('title')
<title>Thông Tin Cá Nhân - CloudBooth</title>
@endsection
@section('noidung')
<base href="{{asset('')}}">
<link rel="stylesheet" title="style" href="source/assets/dest/css/profile3.css">
<div class="menu-title">
	<span style="font-size: 36px">Thông tin cá nhân</span>
</div>

<fieldset style="background: #bdd5fb ; padding: 20px">
	<div class="partinfo">
		<div id="profile" class="row">
			<div class="col-sm-3">
				<div class="profile-title">
					Tên
				</div>
				<div class="profile-info">
					{{ Auth::guard('customer')->user()->name }}
				</div>
			</div>
			<div class="col-sm-5">
				<div class="profile-title">
					Địa chỉ Email
				</div>
				<div class="profile-info">
					{{Auth::guard('customer')->user()->email }}
				</div>

			</div>
			<div class="col-sm-4">
				<div class="profile-title">
					Số điện thoại
				</div>
				<div class="profile-info">
					{{ Auth::guard('customer')->user()->phone }}
				</div>

			</div>
		</div>
		<div id="profile" class="row">
			<div class="col-sm-3">
				
				<div style="margin-top: 30px" class="profile-title">
					Giới tính
				</div>
				<div class="profile-info">
					{{ Auth::guard('customer')->user()->gender }}
				</div>
			</div>
			<div class="col-sm-5">
				<div style="margin-top: 30px" class="profile-title">
					Ngày sinh
				</div>
				<div class="profile-info">
					{{ Auth::guard('customer')->user()->birth_date }}
				</div>

			</div>
			<div class="col-sm-4">
				<div style="margin-top: 30px" class="profile-title">
					Địa chỉ	
				</div>
				<div class="profile-info">
					<a href="{{ route('user.address') }}">Sổ địa chỉ</a>
				</div>

			</div>
		</div>

	</div>
	<div class="partbtn">
		<div class="form-group">
		

				<a href="{{ route('user.profile.edit') }}" class="btn btn-success"> Thay đổi thông tin</a>

				<a href="{{ route('user.profile.changepassword') }}" style="margin-left: 50px" class="btn btn-primary"> Thay đổi mật khẩu</a>
		
		</div>
		
	</div>
	

</fieldset>




@endsection