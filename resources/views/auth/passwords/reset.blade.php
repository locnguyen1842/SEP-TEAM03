@extends('master')
@section('title')
<title>Khôi Phục Mật Khẩu - CloudBooth</title>
@endsection
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
		
		<form action="{{ route('password.request') }}" method="post" class="beta-form-checkout">
			  <input type="hidden" name="token" value="{{ $token }}">
							{{ csrf_field() }}
			<div class="row">
				<div class="col-sm-3"></div>
				@if(session('status'))
				<div class="alert alert-success">{{ session('status')}}</div>
				@endif
				<div class="col-sm-6">
					<h4>Quên mật khẩu</h4>
					<div class="space20">&nbsp;</div>
					<div class="form-block{{ $errors->has('email') ? ' has-error' : '' }}">
						<label for="email">Email</label>
						<input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
						  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
					</div>
					
					<div class="form-block{{ $errors->has('password') ? ' has-error' : '' }}">
						<label for="password">Mật khẩu mới</label>
						<input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
					</div>
					<div class="form-block"{{ $errors->has('password_confirmation') ? ' has-error' : '' }}>
						<label for="password_confirmation">Xác nhận mật khẩu</label>
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
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