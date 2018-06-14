@extends('master')
@section('content')
<div class="container" style="margin-top: 20px;margin-bottom: 20px">
	@if(Cart::instance('default')->count() > 0)
	<div class="col-sm-8" >
		<h4 style="margin-bottom: 20px" >Giỏ hàng</h4 >

		<div  class="panel panel-info">
			<?php $count=1;?>
			@foreach(Cart::content() as $item)
			<div id="cart" class="panel-body" style="min-height: 160px">
				<div class="col-xs-3">
					<a href="{{ route('chitietsp',$item->model->id) }}"><img src="{{ asset('source/image/product/'.$item->model->image) }}" alt=""></a>
				</div>
				<div class="col-xs-5 name-item-cart">
					<div class="col-xs-12" style="word-wrap: break-word;">
						<a href="{{ route('chitietsp',$item->model->id) }}">Sản phẩm: {{ $item->model->name }}</a>
					</div>

					<form class="form-inline">
						<div style="margin-top: 15px" class="col-xs-12 form-group">
							<label style="font-weight: 500"> Số lượng :</label>
							<input data-id="{{ $item->rowId }}" style="height: 24px; width: 60px" class="form-control" min="1" max="10" type="number" name="quantity" id="quantitycart<?php echo $count; ?>" required="" value="{{ $item->qty }}" oninput="validity.valid||(value='');">
							<input type="hidden" name="rowId" id="rowId<?php echo $count; ?>"  value="{{ $item->rowId }}">
							<input type="hidden" name="proId" id="proId<?php echo $count; ?>"  value="{{ $item->model->id }}">

						</div>

					</form>
					
					
					<div class="col-xs-12">
						<p style="margin-top: 15px">Nhà Phân Phối : {{ $item->model->supplier()->first()->shopname }}</p>	

					</div>
				</div>
				<div class="col-xs-3 price-item-cart">

					@if($item->model->promotion_price == 0)
					<p>{{ number_format($item->model->unit_price) }} đ</p>
					@else	
					<span class="flash-sale">
						{{ number_format($item->model->promotion_price) }} đ
					</span>

					<br>
					<span class="flash-del">{{ number_format($item->model->unit_price ) }} đ</span>
					<br>
					@endif


				</div>
				<div class="col-xs-1 action">
					<form action="{{ route('cart.destroy',$item->rowId) }}" method="POST">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<a href="#" onclick="this.parentNode.submit(); return false;" style="color: red">Xóa</a>

					</form>


				</div>


			</div>
			<?php $count++; ?>
			@endforeach
		</div>
	</div>
	
	<div class="col-sm-4">
		<div  class="panel panel-info" style="margin-top: 60px">

			<div id="cart" class="panel-body" style="min-height: 160px">
				<div class="col-sm-12">

					<div class="col-sm-7 label-thanhtoan">
						Tạm tính 
					</div>
					<div class="col-sm-5 gia-thanhtoan">
						{{ number_format(Cart::subtotal()) }}
					</div>
				</div>
				<div class="col-sm-12">
					<div class="col-sm-7 label-thanhtoan">
						Phí VAT (10%) 
					</div>
					<div class="col-sm-5 gia-thanhtoan">
						{{ number_format(Cart::tax()) }}
					</div>
				</div>
				<div class="col-sm-12">

					<div class="col-sm-7 label-thanhtoan">
						Phí vận chuyển 
					</div>
					<div class="col-sm-5 gia-thanhtoan">
						Miễn phí
					</div>
				</div>
				<div class="col-sm-12" style="min-height:20px"></div>
				<div class="col-sm-12" style="background: #ded6d6; border-radius: 20px">

					<div class="col-sm-7 label-tongcong">
						<p class="label-tongcong">Tổng cộng</p> 

					</div>
					<div class="col-sm-5 gia-thanhtoan">
						{{ number_format(Cart::total()) }} đ
					</div>
				</div>
				<br>

				<div class="col-sm-12" style="margin-top: 10px">
					<a href="{{ route('checkout.index') }}"><button class="btn btn-block btn-success">Tiến Hành Thanh Toán</button></a>
				</div>

			</div>
		</div>




	</div>
</div>

</div>
@else
<div class="container" style="margin-top: 20px;margin-bottom: 20px; min-height: 300px">
	<h4 style="margin-bottom: 20px" >Giỏ hàng</h4 >	
	<div  class="panel panel-info" style="margin-top: 20px ">

		<div id="cart" class="panel-body" style="text-align: center;">
			<h1>Hiện Tại Không Có Sản Phẩm Nào Trong Giỏ Hàng </h1>
			<h1><a href="{{ route('trangchu') }}">TIếp Tục Mua Sắm</a> </h1>




		</div>


	</div>
</div>

@endif

@endsection