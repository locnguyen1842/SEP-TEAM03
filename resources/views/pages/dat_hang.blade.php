@extends('master')
@section('title')
<title>Thông Tin Giao Hàng - CloudBooth</title>
@endsection
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đặt hàng</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="index.html">Trang chủ</a> / <span>Đặt hàng</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		<form action="{{ route('checkout.store') }}" method="POST">
		
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<h4>Địa Chỉ Nhận Hàng</h4>
						<div class="space20">&nbsp;</div>
						@foreach($errors->all() as $error)
							{{ $error }}<br>
						@endforeach
						@foreach($address as $item)
						<div  class="panel panel-info">

							<div id="address" class="panel-body">
								<p class="name">

									{{$item->name}}

								</p>
								<p class="address">
									<span>Địa chỉ: </span>
									{{$item->addressde}}

								</p>
								<p class="address">
									<span>Mã vùng: </span>
									{{$item->mavung}}

								</p>
								<p class="phone">
									<span>Điện thoại: </span>
									{{$item->phone}}

								</p>
								<p class="action">
									<div class="radio">
										<label><input type="radio" name="rdaddress" value="{{ $item->id }}">Giao Đến Địa Chỉ Này</label>
									</div>	

								</p>
							</div>

						</div>
						@endforeach

					</div>
					<div class="row">
						<div class="message">Bạn muốn giao hàng đến địa chỉ khác?<a href="javascript:void(0)" class="addNewAddress" id="addNewAddress"> Thêm địa chỉ giao hàng.</a></div>
						<div id="formAddNewAddress" style="display: none;">
							<div class="formaddadress" style="margin-top: 20px">
								


									<input type="hidden" name="_token" value="{{ csrf_token() }}">

									<!-- Form Name -->

									<div class="row">
										@if(count($errors)>0)
										<div class="alert alert-danger">
											@foreach($errors->all() as $error)
											{{ $error }}<br>
											@endforeach
										</div>

										@endif
										@if(Session::has('thanhcong'))
										<div class="alert alert-success">{{ Session::get('thanhcong') }}</div>
										@endif
									</div>
									<!-- Text input-->
									<div class="form-group row">
										<label class="col-md-3 control-label" for="Name (Full name)">Họ Tên</label>  
										<div class="col-md-6">
											<div class="input-group">
												<div class="input-group-addon">
												</i>
											</div>
											<input style="width: 300px" id="name" name="name" type="text" placeholder="Họ và Tên" class="form-control input-md" >
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 control-label" for="adress">Tỉnh/Thành Phố</label>
									<div class="col-md-6">
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
								<div class="form-group row">
									<label class="col-md-3 control-label" for="adress">Quận/Huyện</label>
									<div class="col-md-6">
										<div class="input-group">
											<div class="input-group-addon">
											</div>
											<select style="width: 300px" class="form-control" id="quan_huyen" name="quan_huyen">
												<option selected="true" disabled="true" value="0">--Vui lòng chọn Tỉnh/Thành Phố trước--</option>

											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-md-3 control-label" for="adress">Phường/Xã</label>

									<div class="col-md-6">
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
								<div class="form-group row">
									<label class="col-md-3 control-label" for="Date Of Birth">Địa chỉ</label>  
									<div class="col-md-6">
										<div class="input-group">
											<div class="input-group-addon">
											</div>
											<input style="width: 300px" id="address" name="address" type="text" placeholder="Địa chỉ" class="form-control input-md" ">
										</div>
									</div>
								</div>


								<!-- Multiple Radios (inline) -->


								<div class="form-group row">
									<label class="col-md-3 control-label" for="Phone Number">Số điện thoại</label>  
									<div class="col-md-6">
										<div class="input-group">
											<div class="input-group-addon">


											</div>
											<input style="width: 300px" id="phone" name="phone" type="text" placeholder="Số điện thoại" class="form-control input-md" >

										</div>

									</div>
								</div>
								<!-- Text input-->


								<div class="form-group row">
									<label class="col-md-3 control-label" ></label>  
									<div class="col-md-6">


										<button  type="submit" formaction="{{ route('user.address.add') }}" class="btn btn-primary">Thêm</button>
										<a style="margin-left: 40px" href="" id="huyboaddress" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Hủy bỏ</a>


									</div>
								</div>


							
						</div>

					</div>
				</div>


			</div>

			<div class="col-sm-6">
				<div class="your-order">
					<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
					<div class="your-order-body" style="padding: 0px 10px">
						<div class="your-order-item">
							<div>

								@foreach(Cart::content() as $item)
								<!--  one item	 -->
								<div class="media">
									<img width="25%" src="{{ asset('source/image/product/'.$item->model->image) }}"
									alt="" class="pull-left">
									<div class="media-body">
										<p class="font-large">{{number_format($item->price * $item->qty) }} đồng</p>
										<span class="color-gray your-order-info">Số lượng: {{$item->qty}}</span>
										@if($item->model->promotion_price==0)
										<span class="color-gray your-order-info">Đơn giá: {{
											number_format($item->model->unit_price)}} đồng</span>
											@else
											<span class="color-gray your-order-info">Đơn giá: {{
												number_format($item->model->promotion_price)}} đồng</span>
												@endif

											</div>
										</div>
										<!-- end one item -->
										@endforeach


									</div>
									<div class="clearfix"></div>
								</div>
								<div class="your-order-item">
									<div class="pull-left"><p class="your-order-f18">Tổng tiền ( Chưa bao gồm phí vận chuyển ):</p></div>
									<input type="hidden" name="total" type="text" value="{{Cart::total()}}">
									<div class="pull-right"><h5 class="color-black">{{number_format(Cart::total())}} đồng</h5></div>
									
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>

							<div class="your-order-body">
								<ul class="payment_methods methods">
									<li class="payment_method_bacs">
										<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method"
										value="COD" checked="checked" data-order_button_text="">
										<label for="payment_method_bacs">Thanh toán khi nhận hàng (COD) </label>
										<div class="payment_box payment_method_bacs" style="display: block;">
											Sản phẩm sẽ được gửi tới địa chỉ mà bạn lựa chọn và bạn sẽ trả phí cho đơn hàng (bao gồm phí vận chuyển cho nhân viên giao hàng).
										</div>
									</li>



								</ul>
							</div>
							
								<input type="hidden" name="">
								<div  class="text-center"><button class="btn btn-primary" type="submit">Đặt hàng<i class="fa fa-chevron-right"></i></button></div>
							</form>
							
						</div> <!-- .your-order -->
					</div>


				</div> <!-- #content -->
			</div> <!-- .container -->
			
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
      $('#tinh_tp').on('change', function(e){
        console.log(e);
        var parent_code = e.target.value;
        $.get('{{ route('jsonquan') }}' +'?parent_code='+ parent_code,function(data) {
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
        $.get('{{ route('jsonxa') }}' +'?parent_code='+ parent_code,function(data) {
          console.log(data);
          $('#xa_phuong').empty();
          $('#xa_phuong').append('<option value="0" disable="true" selected="true">--Chọn Xã/Phường--</option>');

          $.each(data, function(index, xa_phuong){
            $('#xa_phuong').append('<option value="'+ xa_phuong.code +'">'+ xa_phuong.name +'</option>');
          })
        });
      });

    </script>
    <script type="text/javascript">
	$(function(){
		$('.addNewAddress').on('click', function(e){
			e.preventDefault();
			$('#formAddNewAddress').show();
		});
		$('#huyboaddress').on('click', function(e){
			e.preventDefault();
			$('#formAddNewAddress').hide();
		});
		
	});
</script>


			@endsection