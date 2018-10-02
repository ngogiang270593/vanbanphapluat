 <!-- Trigger the modal with a button -->

 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Danh sách từ khóa</h4>
        </div>
        <div class="modal-body">
          <table class= 'table table-bordered table-striped' id='lst'>
                  <thead>
                  <tr>
                  <td colspan="9">
                    
                      <!--<input type="submit" class="btn btn-danger" name="btn_delete" id="btn_delete" value="Xóa" style="float: right;margin-left: 10px">-->
                      <form>
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaltukhoa" data-backdrop="static" style="float: right;margin-left: 10px" name="Add" id="modelAdd">Thêm từ khóa</button>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaltukhoa" data-backdrop="static" style="float: right;margin-left: 10px" name="Delete" id="Delete">Xóa từ khóa</button>


                      </form>
                      
                  </td>
                  </tr>
                  <tr>
                    <th></th>
                    <th>STT</th>
                    <th>Từ Khóa</th>
                    <th></th>
                  </tr>
                  </thead> 
                  <?php $i = 1; ?>
                    @foreach ($data as $value)
                    <tr id="">
                    <td><input type="checkbox" name="id[]" class="checkbox" value="{!!$value->id!!}"></td>
                    <td>{!! $i++ !!}</td>
                              <td >{!!$value->keyword!!}</td>
                              <td>
                                  <button class="btn btn-primary btn-xs edit_bm glyphicon glyphicon-pencil tukhoa"  data-toggle="modal" data-target="#modal_edit_keywork" value="{!!$value->id!!}"></button>
                                  
                                  <button type="button" name="Del_BM" id="" class="btn btn-xs btn-danger Del_BM glyphicon glyphicon glyphicon-trash"></button>
                              </td>
                          </tr>
                    
                    @endforeach

              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>