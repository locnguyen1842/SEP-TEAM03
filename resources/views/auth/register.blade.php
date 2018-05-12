@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng kí</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{ route('trangchu') }}">Home</a> / <span>Đăng kí</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		
		<form action="{{ route('dangky') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					@if(count($errors)>0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $error)
						{{ $error }}
						@endforeach
					</div>

					@endif
					@if(Session::has('thanhcong'))
					<div class="alert alert-success">{{ Session::get('thanhcong') }}</div>

					@endif
					<h4>Đăng kí</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email*</label>
						<input class="form-control" type="email" id="email" name="email" required>
					</div>

					<div class="form-block">
						<label for="your_last_name">Họ và tên*</label>
						<input class="form-control" type="text" id="fullname" name="name" required>
					</div>

					<div class="form-block">
						<label for="adress">Địa chỉ*</label>
						<input class="form-control" type="text" id="adress" name="address" required>
					</div>

					<div class="form-block">
						<label for="phone">SĐT*</label>
						<input class="form-control" type="text" id="phone" name="phone" required>
					</div>
					<div class="form-block">
						<label for="password">Mật khẩu*</label>
						<input class="form-control" type="password" id="password" name="password" required>
					</div>
					<div class="form-block">
						<label for="password">Nhập lại mật khẩu*</label>
						<input class="form-control" type="password" id="repassword" name="repassword" required>
					</div>
					<div class="form-block">
						<button  type="submit" class="btn btn-primary">Register</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection