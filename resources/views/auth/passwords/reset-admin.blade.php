@extends('admin.cssjs')
<head>
    <title>Khôi Phục Mật Khẩu | Quản Trị - CloudBooth</title>
    <link rel="icon" href="{!! asset('source/assets/dest/images/logo-cb.png') !!}"/>
</head>
<body>

	<div class="container">
		<div class="row">
			<a href="{{ route('trangchu') }}" id="logo">Quay về trang chủ</a>
		</div>
		<div class="row" style="margin-top: 80px">

			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">ADMIN - Khôi Phục Mật Khẩu</div>
					<div class="panel-body">

						
						<form class="form-horizontal" role="form" method="post" action="{{ route('admin.password.request') }}">
							 <input type="hidden" name="token" value="{{ $token }}">
							{{ csrf_field() }}
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mật Khẩu Mới</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Nhập Lại Mật Khẩu</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

							

							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Xác Nhận
									</button>

									<a class="btn btn-link" href="{{ route('admin.login') }}">
										Quay lại
									</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
