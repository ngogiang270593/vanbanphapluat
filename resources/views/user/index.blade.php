@extends('user_master')
@section ('trangchu_active')
active
@endsection
@section('active')
Trang chủ
@endsection
@section ('content')
<script src="{{ asset('public/libs/datatables.min.js') }}"></script>
    <link href="{{ asset('public/libs/datatables.min.css') }}" rel="stylesheet">
 
   
   <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 style="text-align: center; "> Thông tin các gói thầu  </h2> 
     <span > Thông tin được lấy từ  Hệ Thống Đấu Thầu Điện Tử của bộ Kế Hoạch và Đầu Tư tại địa chỉ: <a href="http://muasamcong.mpi.gov.vn" target="_blank">http://muasamcong.mpi.gov.vn</a></span>
                          
                        </h1>
  <div class="form-group" style="width: 250px; margin-top: 10px;">
  <label for="sel1">Chọn lĩnh vực đấu thầu:</label>
  <select class="form-control" id="luachon">
   <?php $linhvuc =  DB::table('category')->get(); ?>
    <option  value="all"> <strong> Tất cả</strong></option>
   @foreach ($linhvuc as $value )
    <option  value="{{$value->cate_id}}"> <strong>  {{$value->cate_name }}</strong></option>
   @endforeach
    <?php
    $ngayhientai = date('Y-m-d'); 
  // Giờ hiện tại
  $data = DB::table('packages')->where('id',155)->select('created_at')->get();  
?>
   

  </select>
  </div>
              <div >
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="lst">
                        <thead>
                            <tr align="center">
                                <th width="10">Stt</th>
                                <th>Tên gói thầu</th>
                                <th>Bên mời thầu</th>
                                <th width="80">Ngày đăng </th>                                
                            </tr>
                        </thead>
                        <tbody id="result">
                        <?php  $data = DB::table('packages')->where('hided',null)->distinct()->orderBy('id', 'desc')->get(); 
                                $i=1;
                                
                          ?>
                        @foreach ($data as $value) 

                         <tr><td>{{$i}}</td><td><a target = '_blank' href = "{!!$value->link!!}">{!!$value->title!!}
                          <?php $ngaycapnhat =  substr($value->created_at,0,10); ?>
                         @if ($ngayhientai == $ngaycapnhat) 
                         <span style="color: red;" class="dm_new"><strong> Mới! </strong></span> <span class="editlinktip hasTip" style="text-decoration: none; color: #333;"><img src="{{asset('public/image/tooltip.png')}}" border="0" alt="Tooltip"></span>
                         @endif</a></td><td>{!!$value->bidder!!}</td>

                              <td align="center"> {{substr($value->created_at,0,10)}} </td> 

                         </tr>
                          <?php $i++; ?>
                      @endforeach
                       
                        </tbody>
                    </table>
                    </div>

 </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>


        <!-- /#page-wrapper -->
         <script type="text/javascript">
            $(document).ready(function(){
                 $('#lst').DataTable();
});

            $("#luachon").change(function(){
               var ma_linh_vuc = ($(this).val());

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });


          var data = {
              ma_linh_vuc : ma_linh_vuc,             
              _token : $('meta[name="_token"]').attr('content'),            
        }; 

           $.ajax({                   
            type : 'get',          
            url : 'linhvuc', //Here you will fetch records 
            data : data,         
          success : function(data){
            $('#result').html(data);//Show fetched data from database
          }
        });


            });

     
  </script>
  <link rel="stylesheet" type="text/css" href="{{asset('public/datatable/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/datatable/buttons.dataTables.min.css')}} ">
    <link rel="stylesheet" type="text/css" href="{{asset('public/datatable/datatables.min.css')  }}">
    <script type="text/javascript" src="{{asset('public/datatable/bootstrap.min.css')}}j"></script>
    <script type="text/javascript" src="{{asset('public/datatable/vfs_fonts.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('public/datatable/pdfmake.min.js') }}"></script>
     <script type="text/javascript" src="{{asset('public/datatable/jszip.min.js')  }}"></script>
    <script type="text/javascript" src="{{asset('public/datatable/jquery-1.12.4.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('public/datatable/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('public/datatable/datatables.min.js')  }}"></script>
     <script type="text/javascript" src="{{asset('public/datatable/dataTables.buttons.min.js')  }}"></script>
    <script type="text/javascript" src="{{asset('public/datatable/buttons.print.min.js')  }}"></script>
    <script type="text/javascript" src="{{ asset('public/datatable/buttons.html5.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/datatable/buttons.flash.min.js') }}"></script>
    
<script type="text/javascript">
    $(document).ready(function() {
    $('#lst').DataTable( {
         dom: 'Blfrtip',
        
        // "dom": '<"top"i>rt<"bottom"flp><"clear">',
        buttons: [
            'copy',  'excel', 'print'
        ],
         //paging: true
         
    } );
} );
</script>
@endsection
