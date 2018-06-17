@extends('admin.master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý About Us</h1><a href="{{ route('admin.aboutus.edit') }}"><button class="btn btn-primary btn-lg">Chỉnh sửa</button></a>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <!-- /.row -->
        
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    {!! $ab->content  !!}


                </div>
            </div>
        </div>
        <!-- /.col-lg-12 -->
   
    <!-- /.row -->


    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->



<!-- /.row -->

<!-- /.row -->

@endsection