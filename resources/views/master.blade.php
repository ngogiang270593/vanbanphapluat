<head>
    <script src="{{ asset('public/libs/jquery-3.2.0.min.js') }}"></script>
  <script src="{{ asset('public/libs/css/bootstrap.min.js') }}"></script>
   <script src="{{ asset('public/libs/css/bootstrap.js') }}"></script>
  <script src="{{ asset('public/libs/datatables.min.js') }}"></script>
  <link href="{{ asset('public/libs/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/libs/css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('public/libs/datatables.min.css') }}" rel="stylesheet">
   <link href="{{ asset('public/libs/style.css') }}" rel="stylesheet">
  <!-- Scripts -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="Vu Quoc Tuan">
    <title>Trợ Lý Ảo - Admin</title>
    <link href="{{ asset('public/libs/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/libs/datatables.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    
    <link href="{{ asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('public/bower_components/metisMenu/dist/metisMenu.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('public/dist/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

  

  
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle Navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Trợ Lý Ảo</a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{!! route('list-user') !!}">Trang chủ</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Đăng nhập</a></li>
            <li><a href="{{ url('/auth/register') }}">Đăng ký</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Xin chào {{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('profile') }}">Thông tin tài khoản</a></li>
                 <li><a href="{{ url('/authen/getLogout') }}">Đăng xuất</a></li>

              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
  <!--Slidebar-->

<div class="col-sm-2 sidenav" id = "bar-menu">
      <h4>Danh mục</h4>
       <ul class="nav" id="side-menu">
                       
                        <li>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                       
                       
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i>Quản lý tài khoản <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route ('list-user')!!}">Danh sách tài khoản </a>
                                </li>
                                <li>
                                    <a href="{!! route ('add-user')!!}">Thêm tài khoản</a>
                                </li>
                                 <li>
                                    <a href="{!! route ('edit-user')!!}">Sửa thông tin</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul><br>
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search Blog..">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </div>    


        <!-- Page Content -->
      @yield('content')
        <!-- /#page-wrapper -->

    </div>
    <script src="{{ asset('public/libs/jquery-3.2.0.min.js') }}"></script>
  <script src="{{ asset('public/libs/css/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/libs/datatables.min.js') }}"></script>
 
  <!-- Scripts -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src=" {{ asset('public/bower_components/jquery/dist/jquery.min.js') }} "></script>

    <!-- Bootstrap Core JavaScript -->
    <script src=" {{ asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('public/bower_components/metisMenu/dist/metisMenu.min.js') }} "></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('public/bower_components/metisMenu/dist/metisMenu.min.js') }}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{ asset('public/bower_components/DataTables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js') }} ">    </script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
   
</body>

