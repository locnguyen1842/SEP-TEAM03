@extends('account.quanlytaikhoan')
@section('noidung')

<div class="menu-title">
	<span style="font-size: 36px">Chỉnh sửa thông tin</span>
</div>
<form class="form-horizontal" action="{{ route('user.profile.changepassword') }}" method="post">

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
					<input disabled="true" style="width: 247px" id="Email Address" name="txtEmail" type="text" placeholder="" class="form-control input-md" value="{{ Auth::user()->email }}">

				</div>

			</div>
		</div>



		<div class="form-group">
			<label class="col-md-4 control-label" for="Name (Full name)">Mật khẩu hiện tại</label>  
			<div class="col-md-4">
				<div class="input-group">
					<div class="input-group-addon">

					</i>
				</div>
				<input style="width: 247px" id="Name (Full name)" name="txtCurrentPwd" type="password" placeholder="Vui Lòng Nhập mật khẩu hiện tại" class="form-control input-md">
			</div>


		</div>


	</div>
	<div class="form-group">
		<label class="col-md-4 control-label" for="Name (Full name)">Mật khẩu mới</label>  
		<div class="col-md-4">
			<div class="input-group">
				<div class="input-group-addon">

				</i>
			</div>
			<input style="width: 247px" id="Name (Full name)" name="txtNewPwd" type="password" placeholder="Tối thiểu 6 ký tự" class="form-control input-md">
		</div>


	</div>


</div>
<div class="form-group">
	<label class="col-md-4 control-label" for="Name (Full name)">Nhập lại mật khẩu</label>  
	<div class="col-md-4">
		<div class="input-group">
			<div class="input-group-addon">

			</i>
		</div>
		<input style="width: 247px" id="Name (Full name)" name="txtConfirmPwd" type="password" placeholder="Nhập lại mật khẩu mới" class="form-control input-md">
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
	<label class="col-md-4 control-label" ></label>  
	<div class="col-md-6">
		
		
		<button  type="submit" class="btn btn-primary">Xác Nhận</button>
		<a style="margin-left: 40px" href="{{ route('user.profile.index') }}" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Hủy bỏ</a>


	</div>
</div>

</fieldset>
</form>



@endsection