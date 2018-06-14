@extends('admin.master')
@section('content')
<div>
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Chi Tiết Đơn Hàng</h1>
    </div>
    <!-- /.col-lg-12 -->
    <div class="col-lg-12">
      @if(session('thongbao'))
      <div class="alert alert-success">
        {{session('thongbao')}}
      </div>
      @endif
    </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Chi tiết đơn hàng</h3>
        </div>
        <div class="panel-body">
          <p>Mã đơn hàng: <span>{{ $bill->bill_number }}</span></p>
          <p>Ngày đặt hàng: <span>{{ $bill->created_at }}</span></p> 
        </div>
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Thông tin giao hàng</h3>
        </div>
        <div class="panel-body">
          <p>Địa chỉ giao hàng : <span>{{ $bill->address()->first()->addressde }}, {{ $bill->address()->first()->mavung }}</span></p>
          <p>Phương thức thanh toán: <span>COD</span></p>
          <p>Tình trạng đơn hàng: <span>{{ $bill->note }}</span></p>

        </div>
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Thông tin sản phẩm</h3>
        </div>
        <div class="panel-body">
          <table width="100%" class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Hình ảnh</th>
                <th>Tên</th>
                <th>Số lượng</th>

                <th>Giá</th>




              </tr>
            </thead>
            <tbody>
             @foreach($bill->bill_detail() as $item)
              <tr>
               <td><img width="100px" src="source/image/product/{{$sp->image}}"/></td>
               <td>{{ $item->product()->first()->name }}</td>
               <td>{{ $item->quantity }}</td>
               <td>{{ $item->unit_price }}</td>
               </tr> 
             @endforeach

           </tbody>
         </table>
       </div>
     </div>
     <!-- /.panel -->
   </div>
   <!-- /.col-lg-12 -->
 </div>
</div>
@endsection
