@extends('admin_master')
@section('add_active')
active
@endsection
@section('active')
Thêm Tài Khoản
@endsection
 @section ('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 style="text-align: center; ">Thêm người dùng  </h3> 
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
                                <label>Tên người dùng</label>
                                <input class="form-control" name="txtUser" placeholder="Nhập Họ Tên" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="txtPass" placeholder="Nhập Mật Khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="txtRePass" placeholder="Nhập Lại Mật Khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" placeholder="Nhập Email" />
                            </div>
                            <div class="form-group">
                                <label>Cấp độ</label>
                                <label class="radio-inline">
                                    <input name="rdoLevel" value="2" checked="" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoLevel" value="1" type="radio">Thành viên
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm người dùng</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        </div>  
     
@endsection