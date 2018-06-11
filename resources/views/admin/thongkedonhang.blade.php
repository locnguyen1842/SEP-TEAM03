@extends('admin.master')
@section('content')
<div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh Sách Đơn Hàng</h1>
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
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Người mua</th>




                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill as $sp)
                            <tr class="odd gradeX">

                                <td><a href="{{ route('admin.orderdetail',$sp->id) }}">{{$sp->bill_number}}</td></a>
                                <td>{{ $sp->created_at }}</td>






                                <td>{{$sp->note}}</td>
                                <td>{{$sp->customer()->first()->email}}</td>


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
