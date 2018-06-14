@extends('master')
@section('content')

<div class="container" style="margin-top: 20px;margin-bottom: 20px; min-height: 300px">
	<h4 style="margin-bottom: 20px" >Giỏ hàng</h4 >	
	<div  class="panel panel-info" style="margin-top: 20px ">

		<div id="cart" class="panel-body" style="text-align: center;">
			<h1>Đặt Hàng Thành Công. </h1>
			<h1>Cảm Ơn Bạn Đã Tin Tưởng Website Của Chúng Tôi. </h1>
			<h1><a href="{{ route('trangchu') }}"> Tiếp Tục Mua Sắm</a></h1>

		</div>
	</div>

</div>

@endsection