@extends('admin_master')
@section('active')
Cập Nhật Tài Khoản
@endsection
@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cập nhật thông tin người dùng
                          
                        </h1>
                    </div>
                  
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form action="" method="POST">
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
                                <input type="password" class="form-control" value="" name="txtRePass" placeholder="Nhập Lại Mật Khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="txtEmail" value="{!! old ('txtUser',isset($data) ? $data['email'] : null)  !!}" placeholder="Please Enter Email" />
                            </div>
                            <div class="form-group">
                                <label>Cấp độ</label>
                                <label class="radio-inline">
                                    <input name="rdoLevel" value="2"  type="radio"
                                    @if ( $data['level']==2)
                                        
                                        checked="checked"
                                    @endif

                                    >Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoLevel" value="1" type="radio"
                                     @if ( $data['level'] == 1)
                                        
                                        checked="checked"
                                    @endif


                                    >Người dùng
                                </label>
                            </div>
                             <div class="form-group">
                                <label>Trạng thái</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" type="radio"
                                      @if ( $data['status']==1)
                                        
                                        checked="checked"
                                    @endif

                                    >Hoạt động
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="0" type="radio"
                                     @if ( $data['status']==0)
                                        
                                        checked="checked"
                                    @endif
>Ngừng Hoạt Động
                                </label>
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


   

@endsection