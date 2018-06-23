@extends('supplier.master')
@section('title')
<title>Cập Nhật Trạng Thái Đơn Hàng - CloudBooth</title>
@endsection
@section('content')
<div>
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Cập Nhật Đơn Hàng
        <small>{{$billdetail->bills->billnumber}}</small>
      </h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-10" style="padding-bottom:120px">
      @if(count($errors) > 0)
      <div class="alert alert-danger">
        @foreach($errors->all() as $err)
        {{$err}}<br>
        @endforeach
      </div>
      @endif
      
      @if(session('thongbao'))
      <div class="alert alert-success">
        {{session('thongbao')}}
      </div>
      @endif
      
      <form action="{{ route('supplier.thongkedonhang.edit',$billdetail->id) }}" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{csrf_token()}}"/>
        <div class="form-group col-md-6">
          <label>Mã Đơn Hàng</label> 
          <input class="form-control" disabled="" name="mdh" readonly=""  value="{{$billdetail->bills->bill_number}}"/>
        </div>
        <div class="form-group col-md-6">
          <label>Tên sản phẩm</label> 
          <input class="form-control" name="txtTenSP" disabled="" readonly=""  value="{{$billdetail->product->name}}"/>
        </div>
          <div class="form-group col-md-6">
              <label>Trạng Thái</label> 
              <select class="form-control" name="status">             
                <option 
                @if($billdetail->status == "Đang Chờ Xử Lý")
                {{"selected"}}
                @endif
                value="Đang Chờ Xử Lý">Đang Chờ Xử Lý</option>
                
                <option 
                @if($billdetail->status == "Đã Hủy")
                {{"selected"}}
                @endif
                value="Đã Hủy">Đã Hủy</option>
                <option
                @if($billdetail->status == "Đang Giao")
                {{"selected"}}
                @endif
                value="Đang Giao">Đang Giao</option>
                <option
                @if($billdetail->status == "Đã Giao")
                {{"selected"}}
                @endif
                value="Đã Giao">Đã Giao</option>
              </select>
            </div>
        
        <div class="form-group col-md-6" style="margin-top: 25px" >
           
          <button type="submit" class="btn btn-primary">Lưu</button>
           <a href="{{ route('supplier.thongkedonhang.index') }}"><button type="reset" class="btn btn-danger">Quay Lại</button></a>
        </div>
        
      </form>
    </div>
    <!-- /.col-lg-12 -->
  </div>
</div>
@endsection