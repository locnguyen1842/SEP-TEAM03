@extends('master')
@section('content')
<div class="container" style="margin-top: 20px;margin-bottom: 20px">
	@if(Session::has('cart'))
	<div class="col-sm-8" >
		<h4 style="margin-bottom: 20px" >Giỏ hàng</h4 >	
		
		<div  class="panel panel-info">
			@foreach($product_cart as $product)
			<div id="cart" class="panel-body" style="min-height: 160px">
				<div class="col-xs-3">
					<img src="source/image/product/{{$product['item']['image']}}" alt=""></a>
				</div>
				<div class="col-xs-5 name-item-cart">
					<div class="col-xs-12">
						<a href="{{ route('chitietsp',$product['item']['id']) }}">Sản phẩm: {{$product['item']['name']}}</a>
					</div>
					
					<div class="col-xs-6">

						{{$product['qty']}}*<span>@if($product['item']['promotion_price']==0)
								{{$product['item']['unit_price']}} @else {{number_format($product['item']['promotion_price'])}}@endif</span>					</div>
					<div class="col-xs-6">
						
					</div>
					<div class="col-xs-12">
						<p style="margin-top: 15px">Nhà Phân Phối : {{ $product['item']['supplier_id'] }}</p>	
					</div>
					
				</div>
				<div class="col-xs-3 price-item-cart">
					@if($product['item']['promotion_price']=='')
					<p>{{ number_format($product['item']['unit_price']) }} đ</p>
					@else	
					<span class="flash-sale">{{ number_format($product['item']['promotion_price']) }} đ / {{ $product['item']['unit'] }} </span>
					<br>
					<span class="flash-del">{{ number_format($product['item']['unit_price']) }} đ / {{  $product['item']['unit'] }}</span>
					<br>
					@endif

					
				</div>
				<div class="col-xs-1 action">
					<a href="{{route("xoagiohang",$product['item']['id'])}}" style="color: red">Xóa</a>

				</div>

			</div>
			@endforeach
		</div>

	</div>
	<div class="col-sm-4">
		<div  class="panel panel-info" style="margin-top: 60px">
			
			<div id="cart" class="panel-body" style="min-height: 160px">
				<div class="col-sm-12">
					<div class="col-sm-8 label-thanhtoan">
						Tạm tính : 
					</div>
					<div class="col-sm-4 gia-thanhtoan">
						{{number_format(Session('cart')->totalPrice)}}  đ
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-8 label-thanhtoan">
						Phí vận chuyển 
					</div>
					<div class="col-sm-4 gia-thanhtoan">
						Miễn phí
					</div>
				</div>
				<div class="col-sm-12" style="min-height:20px"></div>
				<div class="col-sm-12" style="background: #ded6d6; border-radius: 20px">
					<div class="col-sm-8 label-tongcong">
						<p class="label-tongcong">Tổng cộng</p> 
					</div>
					<div class="col-sm-4 gia-thanhtoan">
						{{number_format(Session('cart')->totalPrice)}}  đ
					</div>
				</div>
				<br>
				
				<div class="col-sm-12" style="margin-top: 10px">
					<a href="{{route('dathang')}}"><button class="btn btn-block btn-success">Tiến Hành Thanh Toán</button></a>
				</div>
				
			</div>
		</div>
		
			
		
	</div>
	@else
	<h4 style="margin-bottom: 20px" >Giỏ hàng</h4 >	
	<div  class="panel panel-info" style="margin-top: 20px">
			
			<div id="cart" class="panel-body" style="text-align: center;">
				<h1>Hiện Tại Không Có Sản Phẩm Nào Trong Giỏ Hàng </h1>

			</div>
		</div>
	@endif
</div> <!-- .container -->
@endsection