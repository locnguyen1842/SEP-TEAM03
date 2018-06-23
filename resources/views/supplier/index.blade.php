@extends('supplier.master')
@section('title')
<title>Nhà Phân Phối - CloudBooth</title>
@endsection
@section('content')
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-home fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ count($sanphams) }}</div>
                                    <div>Sản phẩm</div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="detailthongkesp" id="detailthongkesp" name="detailthongkesp">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{ count($billdetail) }}</div>
                                    <div>Đơn hàng</div>
                                </div>
                            </div>
                        </div>
                       <a href="javascript:void(0)" class="detailthongkedh" id="detailthongkedh" name="detailthongkedh">
                            <div class="panel-footer">
                                <span class="pull-left">Xem chi tiết</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
               
            <!-- /.row -->
            <div class="row" style="display:none; " id="thongkedh">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Thống Kê Đơn Hàng
                <div class="pull-right">

                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Tình Trạng Đơn Hàng</th>
                            <th>Số Lượng</th>
                        </tr>

                    </thead>
                    <tbody>
                       
                        <tr>
                         <td>Đã Giao</td>
                         <td>{{ $dagiao }}</td>
                     </tr>
                      <tr>
                         <td>Đang Giao</td>
                         <td>{{ $danggiao }}</td>
                     </tr>
                     
                      <tr>
                         <td>Đã Hủy</td>
                         <td>{{ $dahuy }}</td>
                     </tr>
                     
                      <tr>
                         <td>Đang Chờ Xử Lý</td>
                         <td>{{ $dadat }}</td>
                     </tr>
                     
                     
                 </tbody>
             </table>
         </div>
         <!-- /.panel-body -->

         <!-- /.col-lg-8 -->

         <!-- /.col-lg-4 -->
     </div>
     <!-- /.row -->
 </div>
</div>
<!-- /.row -->
<div class="row" style="display:none; " id="thongkesp">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Thống Kê Sản Phẩm
                <div class="pull-right">

                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Loại sản phẩm</th>
                            <th>Số Lượng</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($product_type as $item)
                        <tr>
                         <td>{{ $item->name }}</td>
                         <td>{{ ($item->product->where('supplier_id',Auth::guard('supplier')->user()->id)->count()) }}</td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
         <!-- /.panel-body -->

         <!-- /.col-lg-8 -->

         <!-- /.col-lg-4 -->
     </div>
     <!-- /.row -->
 </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.detailthongkesp').on('click', function(e){
            e.preventDefault();
            $('#thongkedh').hide();
            $('#thongkesp').show();

        });
        $('#detailthongkedh').on('click', function(e){
            e.preventDefault();
            $('#thongkesp').hide();
            $('#thongkedh').show();
        });
        
    });
</script>
@endsection