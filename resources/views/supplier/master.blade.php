<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')
    <link rel="icon" href="{!! asset('source/assets/dest/images/logo-cb.png') !!}"/>
    <base href="{{asset('')}}">
    <Base href="{{asset('')}}">

    <!-- Bootstrap Core CSS -->
    <link href="admin/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin/vendors/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="admin/vendors/morrisjs/morris.css" rel="stylesheet">

    <!-- DatetimePicker CSS -->
    <link href="admin/vendors/DatetimePicker/jquery.datetimepicker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- Custom Fonts -->
    <link href="admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    {{-- Script --}}
    <script src="admin/vendors/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/vendors/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/vendors/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="admin/vendors/raphael/raphael.min.js"></script>
    <script src="admin/vendors/morrisjs/morris.min.js"></script>
    <script src="admin/data/morris-data.js"></script>
    <script src="source/assets/dest/ckeditor/ckeditor.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>
    <script type="text/javascript" src="daterangepicker-master/daterangepicker.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="admin/dist/js/sb-admin-2.js"></script>
    <script src="admin/vendors/datatables/js/jquery.dataTables.min.js"></script>
    <script src="admin/vendors/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="admin/vendors/datatables-responsive/dataTables.responsive.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('supplier') }}">Trang gian hàng</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
               
                
                <!-- /.dropdown -->
                

                    <!-- /.dropdown-alerts -->
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ route('supplier.info') }}"><i class="fa fa-user fa-fw"></i> Thông tin gian hàng</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li><a href="{{ route('supplier.logout') }}"><i class="fa fa-sign-out fa-fw"></i> Đăng Xuất</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>

                            <a href="{{ route('supplier') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-truck fa-fw"></i>Quản lý tài khoản<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('supplier.info') }}"><i class="fa fa-user fa-fw"></i> Thông tin gian hàng</a>


                                </li>
                                <li>
                                    <a href="{{ route('supplier.password.edit') }}"><i class="fa fa-unlock-alt fa-fw"></i>Thay Đổi Mật Khẩu</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list fa-fw"></i> Sản Phẩm<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ route('supplier.product.add') }}"><i class="fa fa-plus-square-o fa-fw"></i>Thêm Sản Phẩm</a>
                                </li>
                                <li>
                                    <a href="{{ route('supplier.product.index') }}"><i class="fa fa-list fa-fw"></i>Danh Sách Sản Phẩm</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="{{ route('supplier.thongkedonhang.index') }}"><i class="fa fa-shopping-cart fa-fw"></i>Quản Lý Đơn Hàng</a>


                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
         @yield('content')
     </div>
     <!-- /#page-wrapper -->

 </div>
 <!-- /#wrapper -->

 <!-- jQuery -->




 <script>
    $(document).ready(function() {
        $('#dataTables-supplier-sanpham').DataTable({
            responsive: true
        });
    });
</script>

<script>
	$("#datetimepicker").datetimepicker();
</script>

@yield('script')
</body>

</html>
