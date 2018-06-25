@extends('master')
@section('title')
<title>Đăng Nhập - CloudBooth</title>
@endsection
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng nhập</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{ route('trangchu') }}">Home</a> / <span>Đăng nhập</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		
		<form action="{{ route('dangnhap') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-3"></div>
				
				<div class="col-sm-6">
					<h4>Đăng nhập</h4>
					<div class="space20">&nbsp;</div>
					<div class="form-group">
						@if(Session::has('thongbao'))
				<div class="alert alert-{{Session::get('flag')}}">{{ Session::get('thongbao') }}</div>
				@endif
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input class="form-control" type="email" id="email" name="email" required>
					</div>
					<div class="form-group">
						<label for="password">Mật khẩu</label>
						<input class="form-control" type="password" id="password" name="password" required>
					</div>
					<div class="form-group" style="margin-right: 20px">
						<button type="submit" class="btn btn-primary" style="float: right;">Login</button>
						<a href="{{ route('password.request') }}" style="float: right; margin-right: 20px;margin-top: 7px; color: blue">Quên mật khẩu ?</a>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection