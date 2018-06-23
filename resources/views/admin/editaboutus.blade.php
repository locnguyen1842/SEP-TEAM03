@extends('admin.master')
@section('title')
<title>Thay Đổi About Us - CloudBooth</title>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý About Us</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chỉnh Sửa About Us
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if(count($errors)>0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{ $error }} <br>
                        @endforeach
                    </div>

                    @endif
                    @if(Session::has('thanhcong'))
                    <div class="alert alert-success">{{ Session::get('thanhcong') }}</div>

                    @endif
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="{{ route('admin.aboutus.edit') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="content" name="content"class="form-control" rows="10" required="">{{$ab->content }}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="float: right;">Xác nhận</button>
                            <a href="{{ route('admin.aboutus.index') }}"><button type="reset" class="btn btn-danger" style="float: right; margin-right: 50px">Hủy</button></a>
                            

                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->

                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script type="text/javascript"> CKEDITOR.replace('content',{
   language: 'vi',
});</script>
<!-- /.row -->

@endsection