@extends('user_master')
@section ('keyword_active')
active
@endsection
 @section ('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thêm từ khóa                       
                            
                        </h1>
                        <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Lỗi</strong> Đã xãy ra lỗi.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{!! route ('adminadd')!!}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label>Từ khóa</label>
                                <input class="form-control" name="txtUser" placeholder="Nhập họ tên" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="txtPass" placeholder="Nhập mật khẩu" />
                            </div>
                           
                            <button type="submit" class="btn btn-default">Thêm từ khóa</button>
                             <button type="submit" class="btn btn-default">Trở về</button>
                          
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection