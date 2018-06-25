@extends('admin.master')
@section('title')
<title>Danh Sách Tài Khoản Supplier- CloudBooth</title>
@endsection
@section('content')
<link href="admin/vendors/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Quản lý Supplier</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bảng tài khoản Supplier
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Tên Gian Hàng</th>
                                        <th>Email</th>
                                        
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $item)
                                    <tr class="odd gradeX">
                                        
                                        <td>{{ $item->shopname }}</td>
                                        <td>{{ $item->email }}</td>
                                        
                                        <td class="center">
                                            <a href="{{ route('admin.editsupplier',$item->id) }}">Chỉnh sửa</a>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>


<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
     </script>

@endsection
