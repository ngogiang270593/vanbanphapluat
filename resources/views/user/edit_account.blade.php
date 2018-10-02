@extends('user_master')
@section('active')
Thông Tin Tài Khoản
@endsection
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cập nhật thông tin tài khoản
                            <small>Edit</small>
                        </h1>
                    </div>
                  
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="{{ route ('post_edit_account') }}" method="POST">
                            <div class="form-group">
                            
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <label>Họ tên</label>
                                <input class="form-control" name="txtUser" value="{!! old ('txtUser',isset($data) ? $data['name'] : null)  !!}"  />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="txtPass" value=""placeholder="Vui lòng nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" value="" name="txtRePass" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" value="{!! old ('txtUser',isset($data) ? $data['email'] : null)  !!}" placeholder="Please Enter Email" />
                            </div>
                           
                            <button type="submit" class="btn btn-default">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


     <!--Model Thêm -->  
 <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>


@endsection