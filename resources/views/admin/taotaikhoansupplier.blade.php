@extends('admin.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý Supplier</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Tạo tài khoản Supplier
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{ $error }} <br>
                        @endforeach
                    </div>

                    @endif
                    @if(Session::has('thanhcong'))
                    <div class="alert alert-success">{{ Session::get('thanhcong') }}</div>

                    @endif
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="{{ route('admin.createsupplier') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Email</label>
                                <input name="email" class="form-control" type="email" placeholder="Nhập địa chỉ email" required="">
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                <input name="password" class="form-control" type="password" placeholder="Nhập mật khẩu" required="">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input name="repassword" class="form-control" type="password" placeholder="Xác nhận lại mật khẩu" required="">
                            </div>
                            <button type="submit" class="btn btn-primary" style="float: right;">Xác nhận</button>
                            <button type="reset" class="btn btn-danger" style="float: right; margin-right: 50px">Hủy</button>
                            

                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

@endsection