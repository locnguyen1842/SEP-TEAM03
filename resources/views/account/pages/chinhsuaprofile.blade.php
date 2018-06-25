@extends('account.quanlytaikhoan')
@section('title')
<title>Thay Đổi Thông Tin Cá Nhân - CloudBooth</title>
@endsection
@section('noidung')

<div class="menu-title">
	<span style="font-size: 36px">Chỉnh sửa thông tin</span>
</div>
<form class="form-horizontal" action="{{ route('user.profile.edit') }}" method="post">

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
			<label class="col-md-4 control-label" for="Email Address">Địa chỉ Email</label>  
			<div class="col-md-4">
				<div class="input-group">
					<div class="input-group-addon">


					</div>
					<input disabled="true" style="width: 247px" id="Email Address" name="txtEmail" type="text" placeholder="" class="form-control input-md" value="{{ Auth::guard('customer')->user()->email }}">

				</div>

			</div>
		</div>



		<div class="form-group">
			<label class="col-md-4 control-label" for="Name (Full name)">Họ Tên</label>  
			<div class="col-md-4">
				<div class="input-group">
					<div class="input-group-addon">

					</i>
				</div>
				<input style="width: 247px" id="Name (Full name)" name="txtName" type="text" placeholder="Họ và Tên" class="form-control input-md" value="{{ Auth::guard('customer')->user()->name }}">
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
	<label class="col-md-4 control-label" for="Date Of Birth">Ngày Sinh</label>  
	<div class="col-md-4">

		<div class="input-group">
			<div class="input-group-addon">


			</div>
			<input style="width: 247px" id="Date Of Birth" name="txtBd" type="date" placeholder="Date Of Birth" class="form-control" value="{{ Auth::guard('customer')->user()->birth_date }}">
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
			<input style="width: 247px" id="Phone Number" name="txtPhone" type="text" placeholder="Phone Number" class="form-control input-md" value="{{ Auth::guard('customer')->user()->phone }}">

		</div>

	</div>
</div>
<!-- Text input-->

<div class="form-group">
	<label class="col-md-4 control-label" for="Gender">Giới tính</label>
	<div class="col-md-4"> 
		@if(Auth::guard('customer')->user()->gender =="Nữ")
		<label class="radio-inline" for="Gender-0">
			
			<input  type="radio" name="Gender" id="Gender-0" value="Nam">
			Nam
		</label> 
		<label class="radio-inline" for="Gender-1">
			<input type="radio" name="Gender" id="Gender-1" value="Nữ"  checked="checked">
			Nữ
		</label> 
		@else
		<label class="radio-inline" for="Gender-0">
			
			<input  type="radio" name="Gender" id="Gender-0" value="Nam" checked="checked">
			Nam
		</label> 
		<label class="radio-inline" for="Gender-1">
			<input type="radio" name="Gender" id="Gender-1" value="Nữ" >
			Nữ
		</label> 
		@endif
		
	</div>
</div>


<div class="form-group">
	<label class="col-md-4 control-label" ></label>  
	<div class="col-md-6">
		
		
			<button  type="submit" class="btn btn-primary">Xác Nhận</button>
			<a style="margin-left: 40px" href="{{ route('user.profile.index') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Hủy bỏ</a>
	

	</div>
</div>

</fieldset>
</form>



@endsection