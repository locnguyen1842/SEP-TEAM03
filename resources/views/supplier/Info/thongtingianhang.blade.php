@extends('supplier.master')
@section('title')
<title>Thông Tin Gian Hàng - CloudBooth</title>
@endsection
@section('content')
<link rel="stylesheet" title="style" href="source/assets/dest/css/supplierinfo.css">
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thông Tin Gian Hàng</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-md-8 col-lg-offset-1 col-lg-10">
       <div class="well profile">
        <div class="col-sm-12">
            <div class="col-xs-12 col-sm-8">
                <h2>{{ $supplier->shopname }}</h2>
                <p><strong>Tên Người Sở Hữu: </strong> {{ $supplier->name }} </p>
                <p><strong>Email: {{$supplier->email }}</strong>
                <p><strong>Số điện thoại: </strong>{{ $supplier->phone }}                </p>
                </div>             
                <div class="col-xs-12 col-sm-4 text-center">
                    <figure>
                        <img src="source/supplierlogo/{{ $supplier->logo }}">
                         <p>Logo</p>

                    </figure>
                </div>
            </div>            
            <div class="col-xs-12 divider text-center">
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong> {{ count($product) }} </strong></h2>                    
                    <p><small>Sản phẩm</small></p>
                    <button class="btn btn-success btn-block"><span class="fa fa-plus-circle"></span> sản phẩm </button>
                </div>
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong>{{ count($billdetail) }}</strong></h2>                    
                    <p><small>đơn hàng</small></p>
                    <button class="btn btn-info btn-block"><span class="fa fa-user"></span> Đơn Hàng </button>
                </div>
                <div class="col-xs-12 col-sm-4 emphasis">
                    <h2><strong> </strong></h2>                    
                    <p><small></small></p>
                    <div class="btn-group dropup btn-block">
                      <a href="{{ route('supplier.info.edit') }}"><button style="margin-top: 62px"  type="button" class="btn btn-primary btn-block"><span class="fa fa-gear"></span> Thay Đổi Thông Tin </button></a>
                      
                  </div>
              </div>
          </div>
      </div>                 
  </div>
</div>

<!-- /.row -->

@endsection