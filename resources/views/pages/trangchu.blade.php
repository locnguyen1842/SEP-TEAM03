
@extends('master')
@section('content')
<link rel="stylesheet" title="style" href="source/assets/dest/css/slider.css">

				<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    @for($i = 1 ; $i< count($slide) +1 ;$i++)
    <li data-target="#myCarousel" data-slide-to="{{ $i }}"></li>
    
   @endfor
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  	<div class="item active">
      <img src="source/image/slide/{{ $slideA->image }}" alt="Chania"  width="100%" height="450px">
    </div>
  @foreach($slide as $s)
 
    <div class="item">
      <img src="source/image/slide/{{ $s->image }}" alt="Chania"  width="100%" height="450px">
    </div>
@endforeach
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
					


					
							
					
					<!--slider-->
				
				<div class="container">
					<div id="content" class="space-top-none">
						<div class="main-content">
							<div class="space60">&nbsp;</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="beta-products-list">
										<h4>Sản phẩm mới</h4>
										<div class="beta-products-details">
											<p class="pull-left"><a href="{{  route('spmoi') }} ">Xem thêm</a></p>
											<div class="clearfix"></div>
										</div>

										<div class="row">
											@foreach($new_product as $item)
											<div class="col-sm-3" style="margin-top: 20px">

												<div class="single-item">
													@if($item->promotion_price != null)
													<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
													@endif
													<div class="single-item-header">
														<a href="{{ route('chitietsp',$item->id) }}"><img style="height: 250px" src="source/image/product/{{ $item->image }}" alt=""></a>
													</div>
													<div class="single-item-body">
														<p class="single-item-title">{{ $item->name }}</p>
														<p class="single-item-price">
															@if($item->promotion_price == 0)
															<span>{{ number_format($item->unit_price) }}đ/{{ $item->unit }}</span>


															@else
															<span class="flash-del">{{ number_format($item->unit_price) }}đ/{{ $item->unit }}</span>
															<span class="flash-sale">{{ number_format($item->promotion_price) }}đ/{{ $item->unit }}</span>

															@endif
														</p>
													</div>
													<div class="single-item-caption" style="margin-top: 10px">


														<a class="add-to-cart pull-left" href="{{route('themgiohang',$item->id)}}"><i class="fa fa-shopping-cart"></i></a>
														<a class="beta-btn primary" href="{{ route('chitietsp',$item->id) }}">Details <i class="fa fa-chevron-right"></i></a>

													</div>
												</div>
											</div>
											@endforeach
										</div>
									</div> <!-- .beta-products-list -->


									<div class="space50">&nbsp;</div>

									<div class="beta-products-list">
										<h4>Sản phẩm khuyến mãi</h4>
										<div class="beta-products-details">

											<p class="pull-left"><a href="{{ route('spkhuyenmai') }}">Xem thêm</a></p>
											<div class="clearfix"></div>
										</div>

										<div class="row">
											@foreach($sanpham_khuyenmai as $item)
											<div class="col-sm-3"  style="margin-top: 20px">
												<div class="single-item">
													<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
													<div class="single-item-header">
														<a href="{{ route('chitietsp',$item->id) }}"><img style="height: 250px" src="source/image/product/{{ $item->image }}" alt=""></a>
													</div>
													<div class="single-item-body">
														<p class="single-item-title">{{ $item->name }}</p>
														<p class="single-item-price">
															<span class="flash-del">{{ number_format($item->unit_price) }}đ/{{ $item->unit }}</span>
															<span class="flash-sale">{{ number_format($item->promotion_price) }}đ/{{ $item->unit }}</span>
														</p>
													</div>
													<div class="single-item-caption" style="margin-top: 10px">

														<a class="add-to-cart pull-left" href="{{route('themgiohang',$item->id)}}"><i class="fa fa-shopping-cart"></i></a>
														<a class="beta-btn primary" href="{{ route('chitietsp',$item->id) }}">Details <i class="fa fa-chevron-right"></i></a>
														<div class="clearfix"></div>
													</div>
												</div>
											</div>

											@endforeach

										</div>
									</div> <!-- .beta-products-list -->
								</div>
							</div> <!-- end section with sidebar and main content -->


						</div> <!-- .main-content -->
					</div> <!-- #content -->
				</div> <!-- .container -->
				@endsection

				<script>
					$(document).on('click','.pagination a',function(e){
						e.preventDefault();
						var page = $(this).attr('href')split('page=')[1];
						getSaleProduct(page);
					});
					function getSaleProduct(page){
						$.ajax({
							url: '/index?page='+page
						}).done(function(data){
							$('.row').html(data);
						});
					}

				</script>