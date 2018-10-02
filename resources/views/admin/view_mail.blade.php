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
  <!-- Font Awesome 
  <link rel="stylesheet" href="{{ asset('public/css/fontawesome.min.css') }}">
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
  <link rel="stylesheet" href="{{ asset('public/css/slidebar.css') }}">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('public/style.css') }}"> -->

</head>

<body class ="container">
 <p> Chào @foreach ($name as $values)
        <strong>{{$values->name}}</strong>!
 @endforeach </p>
 Đây là văn bản mới theo từ khóa:

 @foreach ($tukhoa as $key => $values)
        <strong style="overflow: hidden;"><span>{{$values->keyword}}</span></strong>
       @if ($key < (count($tukhoa)-1))<span style="margin-left: -3px; ">,</span>
       @else <label style="margin-left: -3px; ">.</label>
       @endif
 @endforeach
 @if ($count > 0 )
 
<table border="1">

<tr> <th>Văn bản mới</th><th>Ngày cập nhật</th> </tr>

 
  @foreach ($noidung as $value)
    <?php $i=0 ;?>
    @while ($i<($count))
    
    @if (isset ($value[$i]->link))
    
    
    <tr>
        
    <td>
      <a style="text-decoration: none;" href="{!!$value[$i]->link!!}"> {!!$value[$i]->title!!}</a>
    </td>
    <td>
      <span>{!!$value[$i]->created_at!!}</span>
    </td>
    
    
    </tr>
    

    @else
    <?php break; ?>
    @endif
    <?php $i++; ?> 
    @endwhile
  @endforeach
  
</table>
@else
    <p>Không có nội dung cho tài khoản này</p>
@endif
</body>