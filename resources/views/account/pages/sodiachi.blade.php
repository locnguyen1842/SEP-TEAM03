@extends('account.quanlytaikhoan')
@section('title')
<title>Sổ Địa Chỉ - CloudBooth</title>
@endsection
@section('noidung')
<link rel="stylesheet" title="style" type="text/css" href="source/assets/dest/css/addresslist.css">
<div class="menu-title">
	<span style="font-size: 36px">Sổ địa chỉ</span>
</div>

<fieldset style="background: #bdd5fb ; padding: 20px">
	<div class="add-address">
		<a href="{{route('user.address.add')}}" class="add"><i class="fa fa-plus" style="color: #1a9cb7;font-size: 15px"></i>Thêm địa chỉ mới</a>
	</div>
	@foreach($address as $item)
	<div  class="panel panel-info">
		
		<div id="address" class="panel-body">
			<p class="name">

				{{$item->name}}
				<a href="{{route('user.address.edit',$item->id)}}" style="float: right;" class="edit-address"> Chỉnh sửa</a>
			</p>
			<p class="address">
				<span>Địa chỉ: </span>
				{{$item->addressde}}
				<a href="{{route('user.address.delete',$item->id)}}" style="float: right;" class="edit-address"> Xóa</a>
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
				

			</p>
		</div>
	
	</div>
	@endforeach

</fieldset>




@endsection