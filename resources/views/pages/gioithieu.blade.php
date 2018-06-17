@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Giới thiệu</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Giới thiệu</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container" style="min-height: 300px">
		{!! $ab->content !!}
				
			
		<!-- #content -->
	</div> <!-- .container -->
@endsection