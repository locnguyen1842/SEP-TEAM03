@extends('supplier.master')
@section('title')
<title>Thống Kê Đơn Hàng- CloudBooth</title>
@endsection
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
                    <div class="form-inline">
                        <div class="form-group" style="margin-bottom: 5px">
                            <label></label>
                            <input style="width: 200px" class="form-control input-sm" placeholder="Ngày bắt đầu - Ngày kết thúc" name="date_range" id="date_range" type="text" />
                           
                        </div>
                     
                    </div>
                   
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-supplier-tkdonhang">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Sản Phẩm</th>
                            <th>SKU</th>
                            <th>Ngày đặt</th>
                            <th>Đơn Giá</th>
                            <th>Số Lượng</th>
                            <th>Trạng Thái</th>
                            <th></th>
                           



                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bill as $sp)
                        <tr class="odd gradeX">

                            <td><a href="{{ route('supplier.chitietdonhang.index',$sp->id_bill) }}">{{$sp->bills->bill_number}}</td></a>
                            <td>{{ $sp->product->name }}</td>
                            <td>{{ $sp->product->SKU }}</td>
                            <td>{{ date('Y-m-d', strtotime($sp->bills->created_at)) }}</td>
                          
                            	<td>{{number_format($sp->unit_price)}}</td>
                         
                            <td>{{$sp->quantity}}</td>
                            <td>{{ $sp->status }} </td>
                            <td><a href="{{ route('supplier.thongkedonhang.edit',$sp->id) }}"><i class="fa fa-edit"></i>Cập Nhật</a></td>
                            


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
<script>
$(document).ready(function() {

   var table = $('#dataTables-supplier-tkdonhang').dataTable( {
        
        initComplete: function () {
            
            this.api().columns([6]).every( function () {
                var column = this;
                var select = $('<select><option value="">Trạng Thái</option></select>')
                    .appendTo($(column.header()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column
                            
                            .search( val ? '^'+val+'$' : '', true, false  )
                            .draw();
                    } );
                 column.data().unique().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
});
 </script>

<script type="text/javascript">
    $(document).ready( function () {
        var table = $('#dataTables-supplier-tkdonhang').DataTable();
        
    //END of the data table

    // Date range script - Start of the sscript
    $('#date_range').daterangepicker({
        autoUpdateInput: false,
        locale: {
            "cancelLabel": "Clear",
        }
    });

    $('#date_range').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' đến ' + picker.endDate.format('YYYY-MM-DD'));
      table.draw();
  });

    $('#date_range').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
      table.draw();
  });
    // Date range script - END of the script

    $.fn.dataTableExt.afnFiltering.push(
        function( oSettings, aData, iDataIndex ) {
            
            var grab_daterange = $("#date_range").val();
            var give_results_daterange = grab_daterange.split(" đến ");
            var filterstart = give_results_daterange[0];
            var filterend = give_results_daterange[1];
        var iStartDateCol = 3; //using column 2 in this instance
        var iEndDateCol = 3;
        var tabledatestart = aData[iStartDateCol];
        var tabledateend= aData[iEndDateCol];
        
        if ( !filterstart && !filterend )
        {
            return true;
        }
        else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && filterend === "")
        {
            return true;
        }
        else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isAfter(tabledatestart)) && filterstart === "")
        {
            return true;
        }
        else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && (moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)))
        {
            return true;
        }
        return false;
    }
    );

    //End of the datable
});
</script>
@endsection