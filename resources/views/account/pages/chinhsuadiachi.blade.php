@extends('account.quanlytaikhoan')
@section('noidung')

<div class="menu-title">
	<span style="font-size: 36px">Chỉnh sửa địa chỉ</span>
</div>
<form class="form-horizontal" action="{{ route('user.address.edit') }}" method="post">

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
				<input style="width: 247px" id="Name (Full name)" name="txtName" type="text" placeholder="Họ và Tên" class="form-control input-md" value="{{ Auth::user()->customer()->first()->name }}">
			</div>


		</div>


	</div>

{{-- <!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="Upload photo">Upload photo</label>
  <div class="col-md-4">
    <input id="Upload photo" name="Upload photo" class="input-file" type="file">
  </div>
</div> --}}

<!-- Text input-->
<div class="form-group">
	<label class="col-md-4 control-label" for="Date Of Birth">Địa chỉ</label>  
	<div class="col-md-4">

		<div class="input-group">
			<div class="input-group-addon">


			</div>
			<input style="width: 247px" id="Date Of Birth" name="txtBd" type="date" placeholder="Date Of Birth" class="form-control" value="{{ Auth::user()->customer()->first()->birth_date }}">
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
			<input style="width: 247px" id="Phone Number" name="txtPhone" type="text" placeholder="Phone Number" class="form-control input-md" value="{{ Auth::user()->customer()->first()->phone }}">

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



@endsection