@extends('master')
@section('content')
<base href="{{asset('')}}">
<link rel="stylesheet" title="style" href="source/assets/dest/css/profile2.css">
<div class="container">
	<div id="background" class="space-top-none"></div>
	<div class="main-content">
		<div class="row" style="min-height: 500px">
			@section('title')
			   @yield('title')
			@endsection
			<div id="background" class="col-sm-3">
				@include('account.menu')
			</div>
			<div id="background" class="col-sm-1"></div>
			<div id="background" class="col-sm-8">
				@yield('noidung')
			</div>

		</div>
	</div>
	

</div>

@stop
