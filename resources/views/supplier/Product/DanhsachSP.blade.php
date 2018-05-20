@extends('supplier.master')

@section('content')
<div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh Sách Sản Phẩm</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Hình ảnh</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Loại</th>
                                        <th>Giá</th>
                                        <th>Đơn vị</th>
                                        <th>Số lượng</th>
										<th>% Giảm giá</th>
										<th>Ngày đăng</th>
										<th>Sửa</th>
										<th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($Sanpham as $sp)
										<tr class="odd gradeX">
											<td><img width="100px" src="Image/{{$sp->image}}"/></td>
											<td>{{$sp->name}}</td>
											<td>{{$sp->product_Type->name}}</td>
											<td>{{$sp->unit_price}}</td>
											<td>{{$sp->unit}}</td>
											<td>{{$sp->new}}</td>
											<td>{{$sp->promotion}}</td>
											<td>{{$sp->created_at}}</td>
											
											<td class="center"><i class="fa fa-pencil fa-fw"></i><a href="supplier/Product/SuaSP/{{$sp->id}}">Sửa</a></td>
											<td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="supplier/Product/XoaSP/{{$sp->id}}">Xóa</a></td>
										</tr>
									@endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>

@endsection