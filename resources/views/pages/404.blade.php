@extends('master')
@section('title')
<title>Lỗi rồi ! - CloudBooth</title>
@endsection
@section('content')
<div class="container">
		<div id="content" class="space-top-none space-bottom-none">
			<div class="abs-fullwidth bg-gray">
				<div class="space100">&nbsp;</div>
				<div class="space80">&nbsp;</div>
				<div class="container text-center">
					<h2>Oops! Lỗi Rồi o_O!</h2>
					<h4><a href="{{ route('trangchu') }}">Quay Về Trang Chủ</a></h4>
					
					<div class="space30">&nbsp;</div>
					<p>Không Tìm Thầy Trang Bạn Yêu Cầu</p>

					
				</div>
				<div class="space100">&nbsp;</div>
				<div class="space30">&nbsp;</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection