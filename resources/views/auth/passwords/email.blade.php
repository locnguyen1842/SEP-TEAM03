@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Quên mật khẩu</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="{{ route('trangchu') }}">Home</a> / <span>Quên mật khẩu</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		
		<form action="{{ route('pwdemail') }}" method="post" class="beta-form-checkout">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-sm-3"></div>
				
				<div class="col-sm-6">
				@if(session('status'))
				<div class="alert alert-success">{{ session('status')}}</div>
				@endif
					<h4>Quên mật khẩu</h4>
					<div class="space20">&nbsp;</div>
					
					<div class="form-block">
						<label for="email">Email*</label>
						<input class="form-control" type="email" id="email" name="email" required>
					</div>
					
					<div class="form-block" style="margin-right: 20px">
						<button type="submit" class="btn btn-primary" style="float: right;">Gửi</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->

@endsection