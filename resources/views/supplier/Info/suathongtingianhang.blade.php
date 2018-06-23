@extends('supplier.master')
@section('title')
<title>Thay Đổi Thông Tin Gian Hàng - CloudBooth</title>
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
					
					@if(session('thongbao'))
						<div class="alert alert-success">
							{{session('thongbao')}}
						</div>
					@endif
					
					<form action="{{ route('supplier.info.edit') }}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<div>
							<label>Logo Gian Hàng</label>
							<p>
							<img width="200px" src="source/supplierlogo/{{ $supplier->logo }}"/>
							</p>
							<input type="file" name="Hinh"  class="form-control"	/>
						</div>
						<div class="form-group">
							<label>Tên Chủ Sở Hữu</label>	
							<input class="form-control" name="name" required="true" placeholder="Nhập tên sản phẩm" value="{{$supplier->name}}"/>
						</div>
						
						<div class="form-group">
							<label>Số Điện Thoại</label>	
							<input class="form-control" name="phone" required="true" placeholder="Nhập tên sản phẩm" value="{{$supplier->phone}}"/>
						</div>
						<div class="form-group">
							<label>Địa Chỉ Email</label>	
							<input class="form-control" name="email" disabled="true" placeholder="Nhập tên sản phẩm" value="{{$supplier->email}}"/>
						</div>
						<div class="form-group">
							<label>Tên Gian Hàng</label>	
							<input class="form-control" name="shopname" disabled="true" placeholder="Nhập tên sản phẩm" value="{{$supplier->shopname}}"/>
						</div>
					
						
						
						
						<button type="submit" class="btn btn-primary">Lưu</button>
						<button type="reset" class="btn btn-danger">Hủy bỏ</button>
					</form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>

@endsection