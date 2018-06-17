@extends('supplier.master')

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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-supplier-sanpham">
                                <thead>
                                    <tr>
										<th>Hình ảnh</th>
                                        <th>Tên</th>
                                        <th>SKU</th>
                                       
										<th>Ngày đăng</th>
									    <th>Hiển thị</th>
										<th>Thao tác</th>
										
                                    </tr>
                                </thead>
                                <tbody>
									@foreach($Sanpham as $sp)
										<tr class="odd gradeX">
											<td><img width="100px" src="source/image/product/{{$sp->image}}"/></td>
											<td><a href="{{ route('chitietsp',$sp->id) }}">{{$sp->name}}</a></td>
											<td>{{ $sp->SKU }}</td>
											

											

											<td>{{$sp->created_at}}</td>
                                            @if($sp->active == 1)
                                            <td><span style="color: green">Có</span></td>
                                            @endif
                                            @if($sp->active == 0)
                                            <td><span style="color: red">Không</span></td>
                                            @endif
											<td class="center"><i class="fa fa-pencil fa-fw"></i>
                                                <a href="{{ route('supplier.product.edit',$sp->id) }}">Sửa</a> | 
                                                <a href="{{ route('supplier.product.showhide',$sp->id) }}">Ẩn/Hiện</a>|
                                                <a href="{{ route('supplier.product.delete',$sp->id) }}" onclick="return confirm('Bạn có muốn xóa sản phẩm có SKU : {{ $sp->SKU }} hay không?');">Xóa</a>
                                            </td>
											
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