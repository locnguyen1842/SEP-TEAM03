@extends('admin.master'	)

@section('content')
<div id="page-wrapper">
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
                         <!-- <div class="panel-heading">
                            DataTables Advanced Tables
                        </div> -->
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Loại</th>
                                        <th>Giá</th>
										<th>Đơn vị</th>
										<th>Giảm giá</th>
										<th>Ngày tạo</th>
										<th>Chỉnh sửa</th>
										<th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($Sanpham as $sp)
                                    <tr class="odd gradeX" align="center">
										<td>{{$sp->Hinhanh}}</td>
										<td>{{$sp->Ten}}</td>
										<td>{{$sp->Loai}}</td>
										<td>{{$sp->Gia}}</td>
										<td>{{$sp->Donvi}}</td>
										<td>{{$sp->Giamgia}}</td>
										<td>{{$sp->Ngaytao}}</td>
										<td class="center"><i class="fa fa-pencil fa-fw"></i><a href="admin/Product/SuaSp/{{$sp->id}}">Sửa</a></td>
										<td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admim/Product/XoaSP">Xóa</a></td>
										
										
									</tr>
									@endforeach
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4>DataTables Usage Information</h4>
                                <p>DataTables is a very flexible, advanced tables plugin for jQuery. In SB Admin, we are using a specialized version of DataTables built for Bootstrap 3. We have also customized the table headings to use Font Awesome icons in place of images. For complete documentation on DataTables, visit their website at <a target="_blank" href="https://datatables.net/">https://datatables.net/</a>.</p>
                                <a class="btn btn-default btn-lg btn-block" target="_blank" href="https://datatables.net/">View DataTables Documentation</a>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
</div>

@endsection