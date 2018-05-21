@extends('supplier.master')

@section('content')
<div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Sản Phẩm
						<small>{{$Sanpham->name}}</small>
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
					
					<form action="supplier/Product/SuaSP/{{$Sanpham->id}}" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{csrf_token()}}"/>
						<div class="form-group">
							<label>Tên sản phẩm</label>	
							<input class="form-control" name="txtTenSP" placeholder="Nhập tên sản phẩm" value="{{$Sanpham->name}}"/>
						</div>
						<div class="form-group">
							<label>Loại</label>	
							<select class="form-control" name="Loai">
								@foreach($LoaiSP as $lsp)
									<option 
									@if($Sanpham->product_type->id == $lsp->id)
										{{"selected"}}
									@endif
									value="{{$lsp->id}}">{{$lsp->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Giá</label>	
							<input class="form-control" name="txtGia"  type="number" placeholder="Nhập giá cho 1 đơn vị (VNĐ)" value="{{$Sanpham->unit_price}}"/>
						</div>
						<div class="form-group">
							<label>Đơn vị</label>	
							<input class="form-control" name="txtDonVi" placeholder="Nhập đơn vị tính (Kg, gram, hộp...)" value="{{$Sanpham->unit}}"/>
						</div>
						<div class="form-group">
							<label>Số lượng</label>	
							<input class="form-control" name="txtSoLuong" type="number" placeholder="Nhập sô lượng sản phẩm (Trên đơn vị đã nhập)" value="{{$Sanpham->new}}"/>
						</div>
						<div class="form-group">
							<label>Hạn sử dụng</label>	
							<input class="form-control" name="txtHSD" type="number" placeholder="Nhập thời hạn sử dụng của sản phẩm (Ngày)"/>
						</div>
						<div class="form-group">
							<label>Giảm giá</label>	
							<input class="form-control" name="txtGiamGia" type="number" placeholder="Nhập % giảm giá khi còn 1 phần 3 hạn sử dụng (Có thể không nhập)" value="{{$Sanpham->promotion_price}}"/>
						</div>
						<div>
							<label>Hình ảnh</label>
							<p>
							<img width="300px" src="Image/{{$Sanpham->image}}"/>
							</p>
							<input type="file" name="Hinh" class="form-control"	/>
						</div>
						<div class="form-group">
							<label>Mô tả</label>	
							<textarea id="demo" name="txtMoTa"class="form-control ckeditor" rows="5">{{$Sanpham->description}}</textarea>
						</div>
						<button type="submit" class="btn btn-default">Lưu</button>
						<button type="submit" class="btn btn-default">Hủy bỏ</button>
					</form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>

@endsection