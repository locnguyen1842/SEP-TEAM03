<div id="header">
    <div class="header-top">
        <div class="container">
            <div class="pull-left auto-width-left">
                <ul class="top-menu menu-beta l-inline">
                    <li><a href="{{ route('trangchu') }}"><i class="fa fa-home"></i>Cloud Booth</a></li>
                    <li><a href="{{ route('supplier') }}"><i class="fa fa-truck"></i>Đến trang bán hàng</a></li>
                </ul>
            </div>
            <div class="pull-right auto-width-right">
                <ul class="top-details menu-beta l-inline">


                    @if(Auth::guard('customer')->check())
                    <li><a href="{{ route('user.orders') }}"><i class="fa fa-shopping-cart"></i>Theo Dõi Đơn Hàng</a></li>
                    <li><a href="{{ route('user.quanly') }}">Chào! {{Auth::guard('customer')->user()->name}}</a>
                    </li>
                    <li><a href="{{ route('dangxuat') }}">Đăng Xuất</a></li>

                    @else
                    <li><a href="{{ route('dangky') }}">Đăng Ký</a></li>
                    <li><a href="{{ route('dangnhap') }}">Đăng nhập</a></li>
                    @endif
                </ul>
            </div>
            <div class="clearfix"></div>
        </div> <!-- .container -->
    </div> <!-- .header-top -->
    <div class="header-body">
        <div class="container beta-relative">
            <div class="pull-left">
                <a href="{{ route('trangchu') }}" id="logo"><img src="source/assets/dest/images/logo-cb.png"
                 width="200px" alt=""></a>
             </div>
             <div class="pull-right beta-components space-left ov">
                <div class="space10">&nbsp;</div>
                <div class="beta-comp">
                    <form role="search" method="get" id="searchform" action="{{ route('search') }}">
                        <input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..."/>
                        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
                    </form>
                </div>


                <div class="beta-comp">
                 <div class="cart">
                  <a href="{{ route('cart.index') }}">

                   <div class="beta-select"><i class="fa fa-shopping-cart"></i>
                       Giỏ hàng ( 
                       @if(Cart::instance('default')->count() >0)
                       {{ Cart::instance('default')->count() }}
                       @else
                       Trống
                       @endif
                       )

							 {{-- (
							@if(Session::has('cart'))

							{{Session('cart')->totalQty}}

                            @else 

                            Trống 

                            @endif
                            ) --}}
                        </div>
                    </a>


                </div> <!-- .cart -->

            </div>
        </div>
        <div class="clearfix"></div>
    </div> <!-- .container -->
</div> <!-- .header-body -->
<div class="header-bottom" style="background-color: #0277b8;">
	<div class="container">
		<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
		<div class="visible-xs clearfix"></div>
		<nav class="main-menu">
			<ul class="l-inline ov">
				<li><a href="{{ route('trangchu') }}">Trang chủ</a></li>
				<li><a href="{{ URL::current().'/#' }}">Loại Sản Phẩm</a>
					<ul class="sub-menu">
						@foreach($loaisp as $item)
						<li><a href="{{ route('loaisp',$item->id) }} ">{{ $item->name }}</a></li>
						@endforeach
					</ul>
				</li>
				<li><a href="{{ route('gioithieu') }} ">Giới thiệu</a></li>


			</ul>
			<div class="clearfix"></div>
		</nav>
	</div> <!-- .container -->
</div> <!-- .header-bottom -->
</div> <!-- #header -->

<!-- .cart -->

