@extends('account.quanlytaikhoan')
@section('noidung')

<div class="menu-title">
	<span style="font-size: 36px">Thêm Địa Chỉ</span>
</div>
<form class="form-horizontal" action="{{ route('user.address.add')}}" method="post">

	<fieldset style="background: #bdd5fb ; padding: 20px">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<!-- Form Name -->

		<div class="row">
			@if(count($errors)>0)
					<div class="alert alert-danger">
						@foreach($errors->all() as $error)
						{{ $error }}
						@endforeach
					</div>

					@endif
					@if(Session::has('thanhcong'))
					<div class="alert alert-success">{{ Session::get('thanhcong') }}</div>
					@endif
		</div>
		<!-- Text input-->
		<div class="form-group">
			<label class="col-md-4 control-label" for="Name (Full name)">Họ Tên</label>  
			<div class="col-md-4">
				<div class="input-group">
					<div class="input-group-addon">
					</i>
				</div>
				<input style="width: 300px" id="name" name="name" type="text" placeholder="Họ và Tên" class="form-control input-md" >
			</div>
		</div>
	</div>
	<div class="form-group">
	<label class="col-md-4 control-label" for="adress">Tỉnh/Thành Phố</label>
	<div class="col-md-4">
		<div class="input-group">
		<div class="input-group-addon">
	</div>
	<select style="width: 300px" class="form-control" id="tinh_tp" name="tinh_tp">
		<option selected="true" disabled="true" value="0">--Chọn Tỉnh/Thành Phố--</option>
		@foreach ($tinh_tp as $key => $value)
		<option value="{{$value->code}}">{{ $value->name }}</option>
		@endforeach

	
	</select>
</div>
</div>
</div>
	<div class="form-group">
	<label class="col-md-4 control-label" for="adress">Quận/Huyện</label>
	<div class="col-md-4">
		<div class="input-group">
		<div class="input-group-addon">
	</div>
	<select style="width: 300px" class="form-control" id="quan_huyen" name="quan_huyen">
		<option selected="true" disabled="true" value="0">--Vui lòng chọn Tỉnh/Thành Phố trước--</option>

	</select>
</div>
</div>
</div>
<div class="form-group">
	<label class="col-md-4 control-label" for="adress">Phường/Xã</label>
	
	<div class="col-md-4">
		<div class="input-group">
		<div class="input-group-addon">
	</div>
	<select style="width: 300px" class="form-control" id="xa_phuong" name="xa_phuong">
		<option selected="true" disabled="true" value="0">--Vui lòng chọn Quận/Huyện trước--</option>

	</select>
</div>
</div>
</div>

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="Date Of Birth">Địa chỉ</label>  
	<div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">
			</div>
			<input style="width: 300px" id="address" name="address" type="text" placeholder="Địa chỉ" class="form-control input-md" ">
		</div>
	</div>
</div>


<!-- Multiple Radios (inline) -->


<div class="form-group">
	<label class="col-md-4 control-label" for="Phone Number">Số điện thoại</label>  
	<div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">


			</div>
			<input style="width: 300px" id="phone" name="phone" type="text" placeholder="Số điện thoại" class="form-control input-md" >

		</div>

	</div>
</div>
<!-- Text input-->


<div class="form-group">
	<label class="col-md-4 control-label" ></label>  
	<div class="col-md-6">
		
		
			<button  type="submit" class="btn btn-primary">Xác Nhận</button>
			<a style="margin-left: 40px" href="{{ route('user.address') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Hủy bỏ</a>
	

	</div>
</div>

</fieldset>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
      $('#tinh_tp').on('change', function(e){
        console.log(e);
        var parent_code = e.target.value;
        $.get('/SEP-TEAM03/public/json-quan?parent_code=' + parent_code,function(data) {
          console.log(data);
          $('#quan_huyen').empty();
          $('#quan_huyen').append('<option value="0" disable="true" selected="true">--Chọn Quận/Huyện--</option>');

          $('#xa_phuong').empty();
          $('#xa_phuong').append('<option value="0" disable="true" selected="true">--Vui lòng chọn Quận/Huyện trước--</option>');

        

          $.each(data, function(index, quan_huyen){
            $('#quan_huyen').append('<option value="'+ quan_huyen.code +'">'+ quan_huyen.name +'</option>');
          })
        });
      });

      $('#quan_huyen').on('change', function(e){
        console.log(e);
        var parent_code = e.target.value;
        $.get('/SEP-TEAM03/public/json-xa?parent_code=' + parent_code,function(data) {
          console.log(data);
          $('#xa_phuong').empty();
          $('#xa_phuong').append('<option value="0" disable="true" selected="true">--Chọn Xã/Phường--</option>');

          $.each(data, function(index, xa_phuong){
            $('#xa_phuong').append('<option value="'+ xa_phuong.code +'">'+ xa_phuong.name +'</option>');
          })
        });
      });

    </script>



@endsection
