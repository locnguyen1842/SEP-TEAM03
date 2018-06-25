@extends('supplier.master')
@section('title')
<title>Thay Đổi Mật Khẩu - CloudBooth</title>
@endsection
@section('content')
<div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thay Đổi Thông Tin Gian Hàng
						<small>{{$supplier->shopname}}</small>
					</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-10" style="padding-bottom:120px">
					@if(count($errors) > 0)
						<div class="alert alert-danger">
							@foreach($errors->all() as $err)
								{{$err}}<br>
							@endforeach
						</div>
					@endif
					@if(session('thatbai'))
						<div class="alert alert-danger">
							{{session('thatbai')}}
						</div>
					@endif
					@if(session('thanhcong'))
						<div class="alert alert-success">
							{{session('thanhcong')}}
						</div>
					@endif
					
					<form action="{{ route('supplier.password.edit') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>						
						<div class="form-group">
							<label>Địa Chỉ Email</label>	
							<input class="form-control" name="email" disabled="true" readonly="" value="{{$supplier->email}}"/>
						</div>
						<div class="form-group">
							<label>Mật Khẩu Hiện Tại</label>	
							<input class="form-control" name="currentpwd" type="password" />
						</div>
						<div class="form-group">
							<label>Mật Khẩu Mới</label>	
							<input class="form-control" name="newpwd" type="password" />
						</div>
						<div class="form-group">
							<label>Nhập Lại Mật Khẩu Mới</label>	
							<input class="form-control" name="confirmpwd" type="password" />
						</div>
					
						
						
						
						<button type="submit" class="btn btn-primary">Lưu</button>
						<button type="reset" class="btn btn-danger">Hủy bỏ</button>
					</form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>

@endsection