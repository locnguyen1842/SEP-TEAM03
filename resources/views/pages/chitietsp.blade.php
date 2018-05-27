@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm : {{ $sp->name }}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{ route('trangchu') }}">Home</a> / <span>Thông tin chi tiết</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="source/image/product/{{ $sp->image }}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{ $sp->name }}</p>
								<p class="single-item-price">
									<p class="single-item-price">
											@if($sp->promotion_price == '')
												<span>{{ number_format($sp->unit_price) }}đ/{{ $sp->unit }}</span>
											
											
											@else
												<span class="flash-del">{{ number_format($sp->unit_price) }}đ/{{ $sp->unit }}</span>
												<span class="flash-sale">{{ number_format($sp->promotion_price) }}đ/{{ $sp->unit }}</span>
												
											@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							{{-- <div class="single-item-desc">
								<p>{{ $sp->description }}</p>
							</div> --}}
							<div class="space20">&nbsp;</div>

							<p>Số lượng ({{ $sp->unit }})</p>
							<div class="single-item-options">
								
								<select class="wc-select" name="color">
									
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="{{route('themgiohang',$sp->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix" style="padding-top: 8px"><a href="{{route('themgiohang',$sp->id)}}" style="font-size: 18px;padding-left: 15px;">Thêm Vào Giỏ</a></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả</a></li>
							
						</ul>

						<div class="panel" id="tab-description">
							
							{!! $sp->description  !!}
						</div>
						{{-- <div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div> --}}
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản Phẩm Cùng Loại</h4>

						<div class="row">
							@foreach($sp_tuongtu as $item)
							<div class="col-sm-4">
								<div class="single-item">
									@if($item->promotion_price != null)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
									<div class="single-item-header">
										<a href="{{ route('chitietsp',$item->id) }}"><img style="height: 200px" src="source/image/product/{{ $item->image }}" alt=""></a>
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
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="product.html"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{ route('chitietsp',$item->id) }}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">SẢN PHẨM GIẢM GIÁ</h3>
						<div class="widget-body">

							<div class="beta-sales beta-lists">
								@foreach($sp_khuyenmai as $item)
								<div class="media beta-sales-item">
								
									<a class="pull-left" href="{{ route('chitietsp',$item->id) }}"><img src="source/image/product/{{ $item->image }}" alt=""></a>
									<div class="media-body">
										{{ $item->name }} 
												<span class="flash-del">{{ number_format($item->unit_price) }}đ/{{ $item->unit }}</span>
												<span class="flash-sale">{{ number_format($item->promotion_price) }}đ/{{ $item->unit }}</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">Sản phẩm mới</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								@foreach($new_product as $item)
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{ route('chitietsp',$item->id) }}"><img src="source/image/product/{{ $item->image }}" alt=""></a>
									<div class="media-body">
										{{ $item->name }} <br>
										<span>{{ number_format($item->unit_price) }}đ/{{ $item->unit }}</span>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection