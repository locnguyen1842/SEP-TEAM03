@extends('supplier.master')
@section('title')
<title>Thêm Mới Sản Phẩm - CloudBooth</title>
@endsection
@section('content')
<div>
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Thêm Sản Phẩm</h1>
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
			
			<form action="{{ route('supplier.product.add') }}" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				<div class="form-group">
					<label>Tên sản phẩm</label>	
					<input class="form-control" name="txtTenSP" placeholder="Nhập tên sản phẩm"/>
				</div>
				<div class="form-group">
					<label>Loại</label>	
					<select class="form-control" name="Loai">
						@foreach($LoaiSP as $lsp)
						<option value="{{$lsp->id}}">{{$lsp->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Mã SKU</label>	
					<input class="form-control" name="sku" placeholder="Nhập mã SKU" />
				</div>
				<div class="row">
					<div class="form-group col-md-6">
						<label>Giá gốc</label>	
						<input class="form-control" name="txtGia"  type="number" placeholder="Giá gốc sẽ được hiện thị để so sánh với giá bán (nếu có)"/>

					</div>

					<div class="form-group col-md-6">
						<label>Đơn vị</label>	
						<select class="form-control" name="txtDonVi">							
							<option value="Kg">Kg</option>
							<option value="Gram">Gram</option>
							<option value="Thùng">Thùng</option>
							<option value="Hộp">Hộp</option>
							<option value="Nải">Nải</option>
						</select>
						
					</div>						
					

					

				</div>
				
				<div class="form-group">
					<label>Giá bán</label>	
					<input class="form-control" name="txtGiamGia" type="number" placeholder="Giá bán sẽ được dùng để tính toán trên hóa đơn giao hàng, giá bán không được lớn hơn giá gốc"/>
				</div>
				<div class="form-group">
					<label>Số lượng</label>	
					<input class="form-control" name="txtSoLuong" type="number" placeholder="Nhập tổng số lượng sản phẩm (Trên đơn vị đã nhập)"/>
				</div>
				
				<div>
					<label>Hình ảnh</label>
					<input type="file" name="Hinh" class="form-control"	/>
				</div>
				<div class="form-group">
					<label>Mô tả</label>	
					<textarea id="txtMoTa" name="txtMoTa"class="form-control ckeditor" rows="5"></textarea>
				</div>
				<button type="submit" class="btn btn-default">Thêm</button>
				<button type="reset" class="btn btn-default">Hủy bỏ</button>
			</form>
		</div>
		<!-- /.col-lg-12 -->
	</div>
</div>
<script type="text/javascript"> CKEDITOR.replace('txtMoTa',{
   language: 'vi',
});</script>
@endsection