@extends('admin.cssjs')
<head>
    <title>Đăng Nhập | Quản Trị - CloudBooth</title>
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
                    <div class="panel-heading">ADMIN Login</div>
                    <div class="panel-body">

                        
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="col-sm-12">
                           @if(count($errors)>0)
                           <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            {{ $error }} <br>
                            @endforeach
                        </div>

                        @endif
                        @if(Session::has('thongbao'))
                        <div class="alert alert-danger">{{ Session::get('thongbao') }}</div>

                        @endif
                    </div>
                </div>
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('admin.password.request') }}">
                                    Quên Mật Khẩu?
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
