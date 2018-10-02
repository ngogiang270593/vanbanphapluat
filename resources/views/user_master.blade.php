<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Trợ Lý Ảo </title>
  <!-- Tell the browser to be responsive to screen width -->
   <link rel="stylesheet" href="{{ asset('public/new/bootstrap.min.css') }}">
  <script src="{{ asset('public/new/jquery.min.js') }}"></script>
  <script src="{{ asset('public/new/bootstrap.min.js') }}"></script>
   <link href="{{ asset('public/libs/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/libs/buttons.dataTables.min.css') }}" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('public/bootstraps/bootstrap.min.css') }}">
     <script src="{{ asset('public/bootstraps/jquery.min.js') }}"></script>
     <script src="{{ asset('public/bootstraps/bootstrap.min.js') }}"></script> 
     <script src="{{ asset('public/libs/datatables.min.js') }}"></script>  
      <link rel="stylesheet" href="{{ asset('public/bootstraps/bootstrap.min.css') }}">
     <script src="{{ asset('public/bootstraps/jquery.min.js') }}"></script>
     <script src="{{ asset('public/bootstraps/bootstrap.min.js') }}"></script> 
      
    
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('public/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
   <link rel="stylesheet" href="{{ asset('public/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/skins/_all-skins.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/plugins/iCheck/flat/blue.css') }}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ asset('public/plugins/morris/morris.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('public/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('public/plugins/datepicker/datepicker3.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('public/style.css') }}"> 

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

 <header class="main-header"">
    <!-- Logo -->


   
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"  style="height: 100px; background: #006699"  >
      <!-- Sidebar toggle button-->
     
        <span class="sr-only">Toggle navigation</span>

      </a>

      <div class="navbar-custom-menu">
      



       <a class="nav navbar-nav" href="/">

         <!-- <li><a style="width: 90px;" href="{{ url('admin/admin_profile') }}"> Trang Chủ </a></li> -->
          <img  height="80px" width="600px;" alt="logo"  style="margin-left: -900px; margin-top: 5px;" src="{{ asset('public/photo/logo/giaiphap2.png') }}"></img>
        </a>
        
        <ul class="nav navbar-nav navbar-right">

        <?php 
        $ten = Auth::user()->name;
        $sotu = str_word_count($ten);
        $mang = explode(' ', $ten);
        $phantu = $sotu - 2;
        $name = $ten;
       
        ?>
          @if (Auth::guest())
            <li><a href="{{ url('/auth/login') }}">Đăng nhập</a></li>
            <li><a href="{{ url('/auth/register') }}">Đăng ký</a></li>
          @else

            <li style="margin-right: 20px;" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Xin chào <strong> {{$name }}</strong> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('profile') }}"> <span class="glyphicon glyphicon-info-sign"></span> Thông tin tài khoản</a></li>
                 <li><a href="{{ url('/authen/getLogout') }}"><span class="glyphicon glyphicon-off"></span> Đăng xuất</a></li>

              </ul>
            </li>
          @endif
        </ul>
        
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar" >
  <div  style="background: #51A9FF  ; height: 100px; margin-top: -50px;">
   <span class="logo-lg">  <img height="100px" width="130px;" alt="logo"  style="margin-left: 80px; margin-top: 0px;" src="{{ asset('public/photo/logo/logo.png') }}"> </span>
  </div >      
     
      

   <nav  class="navbar navbar-inverse" style="height: 100px;">
    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">
      <!-- Sidebar user panel -->

      <div class="user-panel" style="background: #222222;" >

        <div class="pull-left image">
        <!-- Thay đổi ảnh Avatar -->
        <?php 
        $id = Auth::user()->id;
       
        $src = DB::table('images')->where('user_id',$id)->select('src')->get();
        
        ?>    
        @if (count($src)== 1 )      
         <div style="margin-left: 15px; margin-top: 20px; width: 80px; height: 80px;"> <a  target="_blank" href="/<?php foreach ($src as  $value) {
           echo $value->src;}?>"> <img  src="/<?php foreach ($src as  $value) {
           echo $value->src;   }?>" class="img-circle" alt="User Image" width="60px" height="60px   ">
          </a> </div>
        </div>
        @else 
        <div style="margin-left: 15px; margin-top: 20px; width: 80px; height: 80px;"> <a  target="_blank" href="/public/photo/image/avatar.png"> <img  src="/public/photo/image/avatar.png" alt="User Image" width="60px" height="60px   ">
          </a> </div>
        </div>
        @endif

          

        <div  style="margin-left: 30px; margin-top: 20px;" class="pull-left info">
        
          <p >{{$name}} </p>
           
          <a      href="{!! route ('profile')!!}"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->

    
      <div  style = "margin-top:-10px;  "   class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav" id="side-menu">       
                       
                     
                        <li class="@yield ('trangchu_active')">
                            <a   href="{!! route ('home')!!}"><i class="glyphicon glyphicon-home"></i> Trang chủ gói thầu <span class="fa arrow"></span></a>
                          </li>

                           <li class="@yield ('trangchu1_active')">
                            <a   href="{!! route ('homevanban')!!}"><i class="glyphicon glyphicon-home"></i> Trang chủ văn bản pháp luật<span class="fa arrow"></span></a>
                          </li>
                         
                                <li  class="@yield ('thongtin_active')" >
                                    <a  href="{!! route ('profile')!!}"><i class="  glyphicon glyphicon-user"></i> Thông tin tài khoản   </a>
                                </li>
                                <li  class="@yield ('keyword_active')" >
                                    <a href="{!! route ('keyword')!!}"> <i class="glyphicon glyphicon-th-list"></i> Danh sách từ khóa gói thầu</a>
                                </li>
                                 <li  class="@yield ('keyword2_active')" >
                                    <a href="{!! route ('keywordvanban')!!}"> <i class="glyphicon glyphicon-th-list"></i> Danh sách từ khóa văn bản</a>
                                </li>
                                 <li   class="@yield ('find_active')" >
                                    <a  href="{!! route ('find_package')!!}"> <i class="glyphicon glyphicon-search"></i> Tìm gói thầu</a>
                                </li>
                                 <li   class="@yield ('find1_active')" >
                                    <a  href="{!! route ('find_package_vanban')!!}"> <i class="glyphicon glyphicon-search"></i> Tìm văn bản</a>
                                </li>

                           
                            <!-- /.nav-second-level -->
                       
                    </ul>
                    </div>
                    </nav>
                    <!--
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
      
      </ul> -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">@yield('active')</li>
      </ol>
    </section>
   
    <!-- Page Content -->
 
         @yield('content')
         </div>
  <!-- /.content-wrapper -->
  <footer style="background: #00CED1;" class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Phiên bản</b> 1.0.0
  </div>

  <strong>Copyright &copy; 2018 by TroLyAo</strong>
  </footer>

  
      </div>
    
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Thay đổi Avatar -->
<script type="text/javascript">  

var addNewLogo = function(input){
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            //Hiển thị ảnh vừa mới upload lên
            $('#logo-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
        //submit form để upload ảnh
        $('#img-upload-form').submit();
    }
}
$(document).ready(function(){

  var submitImageForm = function(form){
    toggleLoading(); //show loading mask
    var data = {
            id  : <?php echo  Auth::user()->id ?>,
            image : new FormData(form) ,
           
        };
    $.ajax({
        url: "user/upload", //api upload phía server
        type: "post",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data)
        { 
            alert (data);
            toggleLoading();            
            alert('thành công');
        },
        error: function (data) {
           toggleLoading();
        }
    });
    return false;
}


});

</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('#lst').DataTable();
  });
</script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/js/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->

<!-- Morris.js charts -->
<script src="{{ asset('public/js/raphael-min.js') }}"></script>
<script src="{{ asset('public/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('public/plugins/sparkline/jquery.sparkline.min.js') }}"></script>

<!-- datepicker -->
<script src="{{ asset('public/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/dist/js/demo.js') }}"></script>
<!-- Libs datatable Export file -->

</body>
</html>
