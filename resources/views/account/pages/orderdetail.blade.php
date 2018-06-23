@extends('account.quanlytaikhoan')
@section('title')
<title>Chi Tiết Đơn Hàng - CloudBooth</title>
@endsection
@section('noidung')
<link rel="stylesheet" title="style" type="text/css" href="source/assets/dest/css/addresslist.css">
<div class="menu-title">
	<span style="font-size: 36px">Chi Tiết Đơn Hàng</span>
</div>

<fieldset style="background: #bdd5fb ; padding: 20px">
	
	
	<div  class="panel panel-default">
		<div class="panel-heading"><h3>Thông Tin Đơn Hàng</h3></div>
		<div class="panel-body">
			<p><b>Mã Đơn Hàng :</b> {{ $order->bill_number }}</p>
			<p><b>Ngày Đặt Hàng :</b> {{ $order->created_at }}</p>
			<p><b>Tổng Tiền :</b> {{ number_format($order->total) }}</p>

		</div>
		
	</div>
	<div  class="panel panel-default">
		<div class="panel-heading"><h3>Thông Tin Giao Hàng</h3></div>
		<div class="panel-body">
			<p><b>Địa Chỉ Nhận Hàng :</b> {{ $order->address()->first()->addressde }}, {{ $order->address()->first()->mavung }}</p>
			<p><b>Phương Thức Thanh Toán :</b> COD</p>
			<p><b>Tình Trạng Đơn Hàng :</b> {{ $order->note }}</p>

		</div>
		
	</div>
	<div  class="panel panel-default">
		<div class="panel-heading"><h3>Thông Tin Sản Phẩm</h3></div>
		<div class="panel-body">
			<table width="100%" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Hình ảnh</th>
						<th>Tên</th>
						<th>Số lượng</th>

						<th>Giá</th>




					</tr>
				</thead>
				<tbody>
					@foreach($order->bill_detail as $item)
					<tr>
						<td><img width="100px" src="source/image/product/{{$item->product->image}}"/></td>
						<td><a target="_blank" href="{{ route('chitietsp',$item->product->id) }}">{{ $item->product->name }}</a></td>
						<td>{{ $item->quantity }}</td>
						
						<td>{{ number_format($item->unit_price )}}</td>
						

					</tr> 
					@endforeach

				</tbody>
			</table>

		</div>
		
	</div>
	
	

</fieldset>




@endsection