@extends('account.quanlytaikhoan')
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
				<th scope="col">Sản phẩm</th>
				<th scope="col">Tổng tiền </th>
				<th scope="col">Trạng thái</th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $item)
				
				<tr>
					<th scope="row">{{$item->bill_number}}</th>
					<td>{{$item->created_at}}</td>
					<td>{{$item->bill_detail()->first()->product()->first()->name}}</td>
					<td>{{$item->total}}</td>
					<td>{{$item->note}}</td>
				</tr>
				
			@endforeach
		</tbody>
			
	</table>
	

</fieldset>




@endsection