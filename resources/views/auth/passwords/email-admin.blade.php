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
					<div class="panel-heading">ADMIN - Quên Mật Khẩu</div>
					<div class="panel-body">

						
						<form class="form-horizontal" role="form" method="post" action="{{ route('admin.password.email') }}">
							{{ csrf_field() }}
							<div class="form-group">
								<div class="col-sm-12">
									@if(session('status'))
									<div class="alert alert-success">{{ session('status')}}</div>
									@endif
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-md-4 control-label">E-Mail</label>

								<div class="col-md-6">
									<input id="email" type="email" class="form-control" name="email"  required autofocus>

									@if ($errors->has('email'))
									<span class="help-block">
										<strong>{{ $errors->first('email') }}</strong>
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
