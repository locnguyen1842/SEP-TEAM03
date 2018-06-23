@extends('master')
@section('title')
<title>Sản Phẩm Mới - CloudBooth</title>
@endsection
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm mới</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ route('trangchu') }}">Home</a> /<span>Sản phẩm mới</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($loaisp as $item)
							<li><a href="{{ route('loaisp',$item->id) }} ">{{ $item->name }}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Danh Sách Sản Phẩm</h4>
							<div class="beta-products-details">
								<p class="pull-left">tìm thấy {{ count($count_product) }} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($new_product as $item)
								<div class="col-sm-4" style="margin-top: 20px">
									<div class="single-item">
										@if($item->promotion_price != null)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="product.html"><img style="height: 250px" src="source/image/product/{{ $item->image }}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{ $item->name }}</p>
											<p class="single-item-price">
												@if($item->promotion_price == '')
												<span>{{ number_format($item->unit_price) }}đ/{{ $item->unit }}</span>
											
											
											@else
												<span class="flash-del">{{ number_format($item->unit_price) }}đ/{{ $item->unit }}</span>
												<span class="flash-sale">{{ number_format($item->promotion_price) }}đ/{{ $item->unit }}</span>
												
											@endif
											</p>
										</div>
										<div class="single-item-caption" style="margin-top: 10px">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="product.html">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							{{ $new_product->appends(Request::all())->links() }}﻿
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection