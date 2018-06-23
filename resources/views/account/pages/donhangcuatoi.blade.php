@extends('account.quanlytaikhoan')
@section('title')
<title>Đơn Hàng Của Tôi- CloudBooth</title>
@endsection
@section('noidung')
<link rel="stylesheet" title="style" type="text/css" href="source/assets/dest/css/addresslist.css">
<div class="menu-title">
	<span style="font-size: 36px">Đơn Hàng Của Tôi</span>
</div>

<fieldset style="background: #bdd5fb ; padding: 20px">
	<table class="table table-hover">
		<thead>
			<tr>
				<th scope="col">Mã đơn hàng</th>
				<th scope="col">Ngày đặt hàng</th>
				
				<th scope="col">Tổng tiền </th>
				<th scope="col">Trạng thái</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $item)
				
				<tr>
					<td scope="row"><a href="{{ route('user.orders.detail',$item->id) }}">{{$item->bill_number}}</a></td>
					<td>{{$item->created_at}}</td>
					<td>{{number_format($item->total)}}</td>
					<td>{{$item->note}}</td>
				</tr>
				
			@endforeach
		</tbody>
			
	</table>
	

</fieldset>




@endsection