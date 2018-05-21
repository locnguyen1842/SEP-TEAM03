@extends('account.quanlytaikhoan')
@section('noidung')

<div class="menu-title">
	<span style="font-size: 36px">Them Dia Chi</span>
</div>
<form class="form-horizontal" action="{{ route('user.address.add',$address->id) }}" method="post">

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
				<input style="width: 247px" id="name" name="name" type="text" placeholder="Họ và Tên" class="form-control input-md" >
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
			<input style="width: 247px" id="address" name="address" type="text" placeholder="Địa chỉ" class="form-control input-md" ">
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
			<input style="width: 247px" id="phone" name="phone" type="text" placeholder="Số điện thoại" class="form-control input-md" >

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
