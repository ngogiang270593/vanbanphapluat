<!DOCTYPE html>
<html lang="en">
<head>
  <script src="{{ asset('public/libs/jquery-3.2.0.min.js') }}"></script>
  <script src="{{ asset('public/libs/css/bootstrap.min.js') }}"></script>
  <script src="{{ asset('public/libs/datatables.min.js') }}"></script>
  <link href="{{ asset('public/libs/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/libs/datatables.min.css') }}" rel="stylesheet">
  <!-- Scripts -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
  
  <title>Trợ Lý Ảo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">    
  
 
</head>

    <!--Body -->
  

<body>
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
          <li><a href="{{ url('/') }}">Trang Chủ</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Đăng Nhập</a></li>
            <li><a href="{{ url('/auth/register') }}">Đăng Ký</a></li>
          @else
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Xin chào {{ Auth::user()->name }} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('profile') }}">Thông Tin Tài Khoản</a></li>
                 <li><a href="{{ url('/authen/getLogout') }}">Đăng Xuất</a></li>

              </ul>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

 <!--Slidebar-->

<div class="col-sm-2 sidenav">
      <h4>Danh Mục</h4>
      <ul class="nav nav-pills nav-stacked">
      <li class="active"><a href="index.php">Trang Chủ</a></li>
        <li><a href="{{ route('profile')}}">Quản Lý Tài Khoản</a></li>
        <li><a href="keyword/index.php">Cài Đặt Từ Khóa</a></li>   
        <li><a href="{{ url('/user/find_package') }}">Tìm Kiếm Gói Thầu</a></li>          
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


 <!--Content-->
  @yield('noidung')

  <!-- Kết thúc body -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>   
</body>
<footer class="container-fluid">
  <p>Footer Text</p>
</footer>
</html>
