@extends('admin.master')
@section('title')
<title>Danh Sách Slider - CloudBooth</title>
@endsection
@section('content')
<div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Danh Sách Slider</h1>
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
                                        <th>Hình Ảnh</th>
                                        <th>Mô Tả</th>
                                        <th>Hiển Thị</th>
                                        <td>Thao Tác</td>
                                       
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($slider as $item)
                                        <tr class="odd gradeX">                                    
                                            <td><img width="100px" src="source/image/slide/{{$item->image}}"/></td>
                                            <td style="width: 50%">{{$item->description}}</td>  
                                           
                                                @if($item->index == 1)
                                                    <td><span style="color: green"> Có</span> </td>
                                                @else
                                                    <td><span style="color: red"> Không</span> </td>
                                                @endif

                                                                                       
                                            <td class="center"><a href="{{ route('admin.slider.showhide',$item->id) }}" >Hiển Thị/Ẩn</a>|<a href="{{ route('admin.slider.delete',$item->id) }}"  style="color: red" onclick="return confirm('Bạn có muốn hay không?')">Xóa</a></td>
                                            
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
