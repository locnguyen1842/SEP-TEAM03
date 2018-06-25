@extends('admin.master')
@section('title')
<title>Thống Kê Đơn Hàng - CloudBooth</title>
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
                            
                            <input style="width: 200px" class="form-control input-sm" name="date_range" placeholder="Ngày bắt đầu - Ngày kết thúc" id="date_range" type="text" />
                           
                        </div>
                     
                    </div>
                   
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
                            <td>{{ date('Y-m-d', strtotime($sp->created_at)) }}</td>






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
<script>
$(document).ready(function() {

   var table = $('#dataTables-example').dataTable( {
        
        initComplete: function () {
            
            this.api().columns([2]).every( function () {
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
    var table = $('#dataTables-example').DataTable();
        
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
        var iStartDateCol = 1; //using column 2 in this instance
        var iEndDateCol = 1;
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
