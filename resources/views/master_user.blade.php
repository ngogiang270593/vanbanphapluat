<!DOCTYPE html>
<html lang="en">
<head>  
     <link rel="stylesheet" href="{{ asset('public/bootstraps/bootstrap.min.css') }}">
     <script src="{{ asset('public/bootstraps/jquery.min.js') }}"></script>
     <script src="{{ asset('public/bootstraps/bootstrap.min.js') }}"></script> 
     <script src="{{ asset('public/libs/datatables.min.js') }}"></script>
    <link href="{{ asset('public/libs/datatables.min.css') }}" rel="stylesheet">
 
    
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">   
    <title>Trợ Lý Ảo - User</title>        
    <!-- Bootstrap Core CSS -->    
  </body>
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
          <li><a href="{{ url('/') }}">Trang chủ</a></li>
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

<div class="col-sm-2 sidenav">
      <h4>Danh mục</h4>
       <ul class="nav" id="side-menu">
                       
                     
                        <li>
                            <a href="{!! route ('home')!!}"><i class="fa fa-users fa-fw"></i>Trang chủ <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{!! route ('profile')!!}">Thông tin tài khoản</a>
                                </li>
                                <li>
                                    <a href="{!! route ('keyword')!!}">Danh sách từ khóa</a>
                                </li>
                                 <li>
                                    <a href="{!! route ('find_package')!!}">Tìm gói thầu</a>
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
    <!-- /#wrapper -->  
    
</body>

</html>
