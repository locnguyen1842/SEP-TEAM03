@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Phục hồi mật khẩu</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{ route('trangchu') }}">Home</a> / <span>Phục hồi mật khẩu</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		
		<form action="{{ route('pwdreset') }}" method="post" class="beta-form-checkout">
			 <input type="hidden" name="token" value="{{ $token }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-3"></div>
				@if(session('status'))
				<div class="alert alert-success">{{ session('status')}}</div>
				@endif
				<div class="col-sm-6">
					<h4>Quên mật khẩu</h4>
					<div class="space20">&nbsp;</div>
					
					
					<div class="form-block">
						<label for="email">Mật khẩu mới</label>
						<input class="form-control" type="password" id="email" name="password" required ">
					</div>
					<div class="form-block">
						<label for="email">Xác nhận mật khẩu</label>
						<input class="form-control" type="password" id="email" name="repassword" required ">
					</div>
					<div class="form-block" style="margin-right: 20px">
						<button  type="submit" class="btn btn-primary" style="float: right;">OK</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection