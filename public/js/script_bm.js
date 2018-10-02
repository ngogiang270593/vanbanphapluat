var $path     = 'http://localhost/Final/admin/bo_mon/';
/*
****** Thêm GIảng viên ******
*/
$(document).ready(function(){

  $('#modalbm').on('hidden.bs.modal', function () {
      $('.alert-danger').addClass('hide');
      $('.alert-success').addClass('hide');
  });

    // Khi người dùng click Đăng ký
   $('#submit_add').click(function(e){
    e.preventDefault();
        // Lấy dữ liệu
        var data = {
              Ma_BM     : $('#Ma_BM').val(),
              Ten_BM    : $('#Ten_BM').val(),
        };
        // Gửi ajax
        $.ajax({
            type : "post",
            dataType : "JSON",
            url : $path+"insert.php",
            data : data,
            success : function(result)
            {
                // Có lỗi, tức là key error = 1
                if (result.hasOwnProperty('error') && result.error == '1'){
                    var html = '';
 
                    // Lặp qua các key và xử lý nối lỗi
                    $.each(result, function(key, item){
                        // Tránh key error ra vì nó là key thông báo trạng thái
                        if (key != 'error'){ 
                            html += '<li>'+item+'</li>';
                        }
                    });
                    $('.alert-danger').html(html).removeClass('hide');
                    $('.alert-success').addClass('hide');
                }
                else{ // Thành công
                    $('.alert-success').html('Thêm thành công!').removeClass('hide');
                    $('.alert-danger').addClass('hide');
                    $('#insert_bm_form')[0].reset();
                    $('#all_bm').load($path+"bo_mon_load.php");
                    setTimeout(function(){
                        $('#modalbm').modal('hide');
                        // Ẩn thông báo lỗi
                        $('.alert-danger').addClass('hide');
                        $('.alert-success').addClass('hide');
                    }, 2000);
                }
            }
        });
    });
});
/*
****** show modal cho từng giảng viên và lấy id
*/
$( document ).ready(function(){       
  $('.modal_edit_bm').on('show.bs.modal', function (e) { //Modal Event
      var id = $(e.relatedTarget).data('id'); //Fetch id from modal trigger button
        $.ajax({
          type : 'post',
          url : $path+'modal_edit.php', //Here you will fetch records 
          data :  'post_id='+ id, //Pass $id
          success : function(data){
            $('.form-data').html(data);//Show fetched data from database
          }
        });
    });
});
/*
****** Sửa thông tin giảng viên ******
*/     
$(document).ready(function(){
  $('.modal_edit_bm').on('hidden.bs.modal', function () {
      $('.alert-danger').addClass('hide');
      $('.alert-success').addClass('hide');
  });

     $('.submit_up').click(function(e){
      e.preventDefault();
        // Lấy dữ liệu
        var data = {
              Ma_BM     : $('#Edit_Ma_BM').val(),
              Ten_BM    : $('#Edit_Ten_BM').val(),
        };
 
        // Gửi ajax
        $.ajax({
            type : "post",
            dataType : "JSON",
            url : $path+"update.php",
            data : data,
            success : function(result)
            {
                // Có lỗi, tức là key error = 1
                if (result.hasOwnProperty('error') && result.error == '1'){
                    var html = '';
 
                    // Lặp qua các key và xử lý nối lỗi
                    $.each(result, function(key, item){
                        // Tránh key error ra vì nó là key thông báo trạng thái
                        if (key != 'error'){ 
                            html += '<li>'+item+'</li>';
                        }
                    });
                    $('.alert-danger').html(html).removeClass('hide');
                    $('.alert-success').addClass('hide');
                }
                else{ // Thành công
                    $('.alert-success').html('Thay Đổi thành công!').removeClass('hide');
                    $('.alert-danger').addClass('hide');
                    setTimeout(function(){
                        $('.modal_edit_bm').modal('hide');
                        // Ẩn thông báo lỗi
                        $('.alert-danger').addClass('hide');
                        $('.alert-success').addClass('hide');
                    }, 1000);
                    setTimeout(function(){
                    $('#all_bm').load($path+"bo_mon_load.php");
                    $('.modal-backdrop').remove();
                    }, 1500);
                }
            }
        });
    });
});

/*
****** datatable ******
*/
$(document).ready(function(){
  $('#list_bm').DataTable();
});

