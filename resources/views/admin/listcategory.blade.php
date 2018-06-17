@extends('admin.master')
@section('content')
<div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh Sách Sản Phẩm</h1>
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
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                     <tr>
                                        <th>Tên Loại</th>
                                        <th>Mô Tả</th>
                                        
                                        <th>Thao tác</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $item)
                                        <tr class="odd gradeX">                                    
                                            <td>{{ $item->name }}</td>
                                            <td style="width: 50%">{{$item->desciption}}</td>                                             
                                            <td class="center"><a href="{{ route('admin.category.edit',$item->id) }}" >Chỉnh sửa</a>|<a href="{{ route('admin.category.delete',$item->id) }}"  style="color: red" onclick="return confirm('Bạn có muốn hay không?')">Xóa</a></td>
                                            
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
