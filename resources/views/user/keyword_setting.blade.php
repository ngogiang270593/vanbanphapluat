@extends('user_master')
@section ('keyword_active')
active
@endsection
@section('active')
Danh Sách Từ khóa
@endsection
@section ('content')

 <script src="{{ asset('public/libs/datatables.min.js') }}"></script>
    <link href="{{ asset('public/libs/datatables.min.css') }}" rel="stylesheet">
 
<meta name="_token" content="{{ csrf_token() }}">

   <?php  $data = DB::table('keywords')->where('user_id',Auth::user()->id)->get();       ?>

<div  class="col-sm-12">
<div style="text-align: center; ">
     <h2  >Danh sách từ khóa đã thêm vào</h2>    
</div>
      <div id="table_bm"> 
               <table class= 'table table-bordered table-striped' id='lst'>
                  <thead>
                  <tr>
                  <td colspan="9">
                    
                      <!--<input type="submit" class="btn btn-danger" name="btn_delete" id="btn_delete" value="Xóa" style="float: right;margin-left: 10px">-->
                      <form>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaltukhoa" data-backdrop="static" style="float: right;margin-left: 10px" name="Add" id="modelAdd">Thêm từ khóa</button>
                        <button type="button" class="btn btn-danger Delete_TuKhoa" data-toggle="modal" data-target="#modaltukhoa" data-backdrop="static" style="float: right;margin-left: 10px" name="Delete" id="Delete">Xóa từ khóa</button>
                      </form>
                      
                  </td>
                  </tr>
                  <tr>
                    <th width="30"></th>
                    <th width="50">Stt</th>
                    <th>Từ khóa</th>
                    <th>Thao thác</th>
                  </tr>
                  </thead>
                  <div class="alert alert-success" id="success" hidden="true"></div> 
                  <?php $i = 1; ?>
                    @foreach ($data as $value)
                    <tr id="">
                    <td style="text-align: center;"><input type="checkbox" name="id[]" class="checkbox" value="{!!$value->id!!}"></td>
                    <td style="font-size: 150%;" style="text-align-last: center; ">{!! $i++ !!}</td>                    
                              <td style="font-size: 150%;">{!!$value->keyword!!}</td>
                              <td>
                                  <button class="btn btn-primary btn-xs edit_bm glyphicon glyphicon-pencil tukhoa"  data-toggle="modal" data-target="#modal_edit_keywork" value="{!!$value->id!!}"></button>
                                  
                                  <button type="button" name="Del_GoiThau" id="" class="btn btn-xs btn-danger Del_GoiThau glyphicon glyphicon glyphicon-trash" value="{!!$value->id!!}"></button>
                              </td>
                          </tr>
                    
                    @endforeach

              </table>

<!-- Model Cập Nhật thông tin -->
  <!-- Modal thêm-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thêm từ khóa</h4>
        </div>
        <div class="modal-body">
      <div class="form-group">
  <label for="usr">Từ khóa:</label>
  <input type="text" class="form-control" id="keyword" required>
</div>
        </div>
        <div class="modal-footer">
                  <button type="button" class="btn btn-success Add" data-dismiss="modal" id='Add'>Thêm</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">Đóng</button>

        </div>
      </div>
      
    </div>
  </div>
  <!-- Modal Edit Từ Khóa-->
  <div class="modal fade" id="modelEdit" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Thay đổi từ khóa</h4>
        </div>
        <div class="modal-body">
      <div class="form-group">
  <label for="usr">Từ khóa:</label>
  <input type="text" class="form-control" id="keyword_edit" value="" required>
  <input type="hidden" class="form-control" id="id_edit" value="">
</div>
        </div>
        <div class="modal-footer">
                  <button type="button" class="btn btn-success Edit-goi-thau" data-dismiss="modal" id='Edit-goi-thau'>Cập nhật</button>
          <button type="button" class="btn btn-success" data-dismiss="modal">Đóng</button>

        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    //Xóa từ khóa
    $(".Delete_TuKhoa").click(function(){
      var r = confirm("Bạn có muốn xóa từ khóa?");
        if (r == true) {
         var id = [];  
       $(':checkbox:checked').each(function(i){  
         id[i] = $(this).val();  
        });  

         $.ajax({                   
          type : 'get',          
          url : 'deletekey', //Here you will fetch records 
          data : {id:id},         
          success : function(data){
          
            $('#result').html(data);//Show fetched data from database
            location.reload();
          }
        });
           
       } else {
        txt = "You pressed Cancel!";
       }
    });

    $(".Del_GoiThau").click(function(){
      var r = confirm("Bạn có muốn xóa từ khóa?");
      if(r == true){
          var id = $(this).val();
          $.ajax({                   
            type : 'post',          
            url : 'deletekey_goithau', //Here you will fetch records 
            data : {id:id},         
            success : function(data){
              location.reload();
            }
          });
      }
    });

    // Chỉnh Sửa Từ Khóa 
    $(".tukhoa").click(function(){
        $("#id_edit").val("");
        $("#keyword_edit").val("")
        var id = $(this).val(); 
        $.ajax({
          url     : "get_keyword_goithau",
          type    : "POST",
          data    : {
              'id'  : id
          },
          dataType: 'json',
          success:function(re){
              $("#keyword_edit").val(re.keyword)
              $("#id_edit").val(id);
              $('#modelEdit').modal('show');
          }
        });
    });

    $(".Edit-goi-thau").click(function(){
      var data = {
          'user_id' : <?php echo Auth::user()->id?>,
          'keyword' : $("#keyword_edit").val(),  
          'id' : $("#id_edit").val(),             
          _token : $('meta[name="_token"]').attr('content'),            
      };
      $.ajax({                   
        type : 'POST',          
        url : 'editkeygoithau', //Here you will fetch records 
        data : data,
        dataType: 'json',         
        success : function(data){
          location.reload();
          $("#success").show().html("Cập nhật thành công");
        }
      });
    });

  // Thêm từ khóa
     $("#modelAdd").click(function(){
        $("#keyword").val('');
        $('#myModal').modal('show');
     });
  
     $(".Add").click(function(){     
          var data = {
              user_id : <?php echo Auth::user()->id?>,
              keyword     : $("#keyword").val(),               
              _token : $('meta[name="_token"]').attr('content'),            
        };
          $.ajax({                   
          type : 'post',          
          url : 'addkeygoithau', //Here you will fetch records 
          data : data,         
          success : function(data){
            $('#result').html(data);//Show fetched data from database
            location.reload();
          }
        });
            
     });

  });
</script>


</div>
</div>
@endsection

  