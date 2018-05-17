@extends('admin.master')
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
                                        <th>Tên công ty</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $item)
                                    <tr class="odd gradeX">
                                        
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td class="center">
                                            <a href="{{ route('admin.deletesupplier',$item->id) }}" style="color: red" onclick="return confirm('Bạn có muốn xóa {{ $item->email }} tài khoản hay không?');"><i class="fa fa-remove"></i>    Xóa</a>
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
