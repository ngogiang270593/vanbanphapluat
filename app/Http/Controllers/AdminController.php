<?php namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Mail;
use Input;
use DB;
use Auth;
use App\Packages;
use App\Packages2;
use App\SentEmail;
use App\SentEmail2;
use App\Http\Requests\AddUser;
use Hash;
use File; 
use App\Images;
class AdminController extends Controller {
	public function UserList (){
        $user = User::select('id','name','email','level','status','receive_email')->orderBy('id','DESC')->get()->toArray();
        //dd($user);
		 return view ('admin.user_list',compact('user'));
	}
	public function GetUserAdd (){
		 return view ('admin.user_add');
	}
	// Post ajax Edit myacount 
    public function EditMyAccount (Request $request){
        if ($request->ajax()){
        $id = Auth::user()->id;
        $user = User::find($id);
        if ($request->input('txtPass')){
            $this->validate ($request, 
                ['txtRePass'=>'same:txtPass'],
                ['txtRePass.same'=>"Mật khẩu không trùng khớp"]);
            $pass = $request->txtPass;
            $user->password = Hash::make($pass);
        }
        $user->name = $request->txtUser;
        $user->email = $request->txtEmail;      
        $user->remember_token = $request->input('remember_token');          
        $user->save();      
        $success = "<script type='text/javascript'>
        alert ('Thay đổi thông tin thành công');
        location.reload();
        </script>";
        return  $success;
            }

    }
    // Get Model Ajax Edit account 
     public function GetEditMyAccount (Request $request) {
    if ($request->ajax()){
        $id = $request->id;
        $data = User::findOrFail($id)->toArray();  
        

      echo "       <form action=''  name = 'editForm'>
                            <div class='form-group'>
                             <input type='hidden' name='id' id='_id' value='"; echo $id; echo "'/>";
echo "                             <input type='hidden' name='_token' value='"; 
                             echo csrf_token();
                              echo "'>
                               <label>Tên người dùng</label>
                                <input class='form-control' name='txtUser' id='edtName' value='"; 
                                echo $data['name']; 

                                 echo "'  />
                            </div>   ";
        echo "<div class='form-group'>
                                <label>Mật khẩu</label>
                                <input type='password' class='form-control' name='txtPass' id='edtPass' value=''placeholder='Vui lòng nhập mật khẩu' />
                            </div>
                             <div class='form-group'>
                                <label>Nhập lại mật khẩu</label>
                                <input type='password' class='form-control' value='' name='txtRePass' placeholder='Nhập lại mật khẩu' />
                            </div>";
        echo "<div class='form-group'>
                                <label>Email</label>
                                <input type='email' class='form-control' name='txtEmail' id='edtEmail' value='";
                                echo  $data['email'];
                                echo " ' placeholder='Please Enter Email' />
                            </div>      
                        <form>";


  echo " <script>
            $('#EditModel').modal('show');
                </script> ";
       // DB::table('users')->where('id',$id)->delete();
}
}


	// Thêm User từ Admin
    public function AddUser (AddUser $request){
        if ($request->ajax()){
     $nguoidung = new User;
    $nguoidung->name = $request->txtUser;
		$nguoidung->email = $request->txtEmail;		
		$nguoidung->password = Hash::make($request->txtPass);
		$nguoidung->remember_token = $request->_token;
		$nguoidung->level =  $request->rdoLevel;	
        $nguoidung->status = 1; 			
		$nguoidung->save();		
    
		return redirect ('admin/add-user');
    }

    }
    // 
    public function GetUserEdit ($id){
    	$data = User::findOrFail($id)->toArray();    	
    	return view ('admin.user_edit',compact('data'));
    	

    }
    // Edit User  (By Ajax ())
   public function GetEditUser (Request $request) {
    if ($request->ajax()){
        $id = $request->id;
        $data = User::findOrFail($id)->toArray();  
        

      echo "       <form action=''  name = 'editForm'>
                            <div class='form-group'>
                             <input type='hidden' name='id' id='_id' value='"; echo $id; echo "'/>";
echo "                             <input type='hidden' name='_token' value='"; 
                             echo csrf_token();
                              echo "'>
                               <label>Tên người dùng</label>
                                <input class='form-control' name='txtUser' id='edtName' value='"; 
                                echo $data['name']; 

                                 echo "'  />
                            </div>   ";
        echo "<div class='form-group'>
                                <label>Mật khẩu</label>
                                <input type='password' class='form-control' name='txtPass' id='edtPass' value=''placeholder='Vui lòng nhập mật khẩu' />
                            </div>
                             <div class='form-group'>
                                <label>Nhập lại mật khẩu</label>
                                <input type='password' class='form-control' value='' name='txtRePass' placeholder='Nhập lại mật khẩu' />
                            </div>";
        echo "<div class='form-group'>
                                <label>Email</label>
                                <input type='email' class='form-control' name='txtEmail' id='edtEmail' value='";
                                echo  $data['email'];
                                echo " ' placeholder='Please Enter Email' />
                            </div>";
        echo " <div class='form-group'>
                                <label>Cấp độ</label>
                                <label class='radio-inline'>
                                    <input name='rdLevel' class='rdLevel' value='2'  type='radio'";

                                    if ( $data['level']==2){
                                        
                                      echo "  checked='checked' ";
                                    }

                                   echo " >Admin
                                </label>
                                <label class='radio-inline'>
                                    <input name='rdLevel' class='rdLevel' value='1' type='radio'";
                                     if ( $data['level'] == 1)
                                        {
                                       echo " checked='checked'";
                                      }
                                   echo "


                                    >Người dùng
                                </label>
                            </div>
                             <div class='form-group'>
                                <label>Trạng thái</label>
                                <label class='radio-inline'>
                                    <input name='rdStatus' value='1' class='rdStatus' type='radio'";

                                      if ( $data['status']==1) {
                                        
                                       echo " checked='checked'";
                                      }
                                    echo "

                                    >Hoạt động
                                </label>
                                <label class='radio-inline'>
                                    <input name='rdStatus' value='0' type='radio' class='rdStatus'";
                                     if ( $data['status']==0)
                                     {   
                                      echo "  checked='checked'";
                                    }
                                    echo "
>Ngừng hoạt động
                                </label>
                            </div>";
                             echo "<div class='form-group'>
                                <label style='margin-top: -5px; '  >Nhận thông tin văn bản mới qua email</label>
                                <input style='margin-left:5px; margin-top:10px; ' type='checkbox'   name='cbEmail' class = 'cbEmail' ";

                                    if ($data['receive_email']==1) 
                                        echo "checked = 'checked'";

                                echo " id='cbEmail' value='";
                                echo $data['receive_email'];
                                echo "'/>
                            </div>
                            
                        <form>";


  echo " <script>
            $('#EditModel').modal('show');
                </script> ";
       // DB::table('users')->where('id',$id)->delete();
}
}

 // Get trang thống kê
    public function GetDashBoard(){
        return view ('admin.dash_board');

    }
     public function postEditUser ( Request $request){
     if ($request->ajax()){
        $id = $request->id;
     	$user = User::find($id);
     	if ($request->input('txtPass')){
     		$this->validate ($request, 
     			['txtRePass'=>'same:txtPass'],
     			['txtRePass.same'=>"Mật khẩu không trùng khớp"]);
     		$pass = $request->txtPass;
     		$user->password = Hash::make($pass);
     	}
     	$user->name = $request->txtUser;
		$user->email = $request->txtEmail;	
		$user->level =  $request->rdoLevel;	
		$user->status =  $request->rdoStatus;	
        $user->receive_email = $request->cbEmail;
		$user->remember_token = $request->input('remember_token');
        $user->save();		
		
		//return redirect ('admin/list-user');
    }
    return "<script> location.reload(); </script>";

    }
	

// Get profile 
 public function GetProfile (){    	
		return view ('admin.account_manager');		

}

 public function UpLoadImage (Request $request){  	
 	  if ($request->file('file')){
 	  $id = Auth::user()->id; 	
 	  $name = $id."+".Input::file('file')->getClientOriginalName();
 	  $src = 'public/photo/image/'.$name; 	 	
 	  $result = Images::where('user_id','=',$id);
 	  $row = count($result);
 	
 	  if ($row == 1) {
 	  	$path =DB::table('images')->where('user_id',$id)->select('src')->get();
 	  	foreach ($path as $key => $value) {
 	  		$delete=  $value->src;

 	  		File::Delete($delete);
 	  	}
 	  	
 		DB::table('images')->where('user_id',$id)->delete();
 		Input::file('file')->move('public/photo/image', $name); 
 	    $image = new Images;
 	    $image->user_id = $id;
 	    $image->src = $src;
 	    $image->save();
 	    return view ('admin.account_manager');
 	    
 	} else 
 	{
 		 Input::file('file')->move('public/photo/image', $name); 
 	  $image = new Images;
 	  $image->user_id = $id;
 	  $image->src = $src;
 	  $image->save();
 	   return 'File was moved.';
      return view ('admin.account_manager');  

}  
 	} else {
 		$erorr = "Bạn chưa chọn ảnh";
 		 return view('admin.account_manager',compact('erorr'));
 	}

     

 }

 public function GetEditAccount (){
	$id = Auth::user()->id;
	$data = User::findOrFail($id)->toArray();  
	return view ('admin.edit_account',compact('data'));
}

public function DeleteUser (Request $request) {
    if ($request->ajax()){
        $id = $request->id;
        $ketqua = DB::table('users')->where('id',$id)->delete();

}
 return $ketqua;
}
public function postEditAccount (Request $request){     	
     	$id = Auth::user()->id;
     	$user = User::find($id);
     	if ($request->input('txtPass')){
     		$this->validate ($request, 
     			['txtRePass'=>'same:txtPass'],
     			['txtRePass.same'=>"Mật khẩu không trùng khớp"]);
     		$pass = $request->txtPass;
     		$user->password = Hash::make($pass);
     	}
     	$user->name = $request->txtUser;
		$user->email = $request->txtEmail;		
		$user->remember_token = $request->input('remember_token');			
		$user->save();		
	    $success = "<script type='text/javascript'>
        alert ('Thay đổi thông tin thành công');
</script>";
		return view ('admin.account_manager',compact('success'));

    }
    
    public function GetListPackage (){
    	return view ('admin.list_package');
    }

     public function GetListPackagekho (){
        return view ('admin.list_package_kho');
    }


     public function GetListPackagevanban (){
        return view ('admin.list_package_vanban');
    }
   
// Gửi Emmail khi Admin yêu cầu
   public function SendMail (){    
    $data =DB::table('users')->get();
         foreach ($data as $bac1) {
            $mail = $bac1->email;
            $id = $bac1->id;
            $user_name = $bac1->name;
            $tukhoa = DB::table('keywords')->where('user_id',$id)->get();
            $noidung = array();         
            $count = 0;
           foreach ($tukhoa as  $bac2) {
                $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%' order by id DESC");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent_emails where user_id='$id_taikhoan' and package_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                             $sent_emails = new SentEmail;
                             $sent_emails->user_id=$id_taikhoan;
                             $sent_emails->package_id = $id_cankiemtra;
                             $sent_emails->save();
                           

                        }
                }
               
                
                }                       
            if ($count>0) {
            Mail::send('process.email',array('noidung'=>$noidung,'count'=>$count,'name'=>$user_name),
             function($message) use ($mail) {
                $message->to($mail)->subject('Thông tin gói thầu');
            }); 
            }
        
         //   return    ProcessController::GuiGoiThau($mail,$noidung);
            
        }
    //    return view ('admin.user_list');
     //return view ('admin.list_package');

   }
   ///Mở giao diện send email cho từng người
   public function SendEmailSetting (){
    return view ('admin.send_email_setting');
   }

    public function SendEmailSettingvanban (){
    return view ('admin.send_email_setting_vanban');
   }
 
 // Xử lý gửi dữ liệu cho từng người.
   public function CustomSendMail (Request $request){
        $user_id  = $request->id;    
        $data =DB::table('users')->where('id',$user_id)->get();
         foreach ($data as $bac1) {
            $mail = $bac1->email;
            $id = $bac1->id;
            $user_name = $bac1->name;
            $tukhoa = DB::table('keywords')->where('user_id',$id)->get();
            $noidung = array();    

            $count = 0;
            foreach ($tukhoa as  $bac2) {
                $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%' order by id DESC");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent_emails where user_id='$id_taikhoan' and package_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                             $sent_emails = new SentEmail;
                             $sent_emails->user_id=$id_taikhoan;
                             $sent_emails->package_id = $id_cankiemtra;
                             $sent_emails->save();
                           

                        }
                }
               
                
                }      

            $count = count ($noidung);
            

        // Gửi email                
            if ($count>0) {
            Mail::send('process.email',array('noidung'=>$noidung,'count'=>$count,'name'=>$user_name,'keyword'=>$tukhoa),
             function($message) use ($mail) {
                $message->to($mail)->subject('Thông tin gói thầu');
            }); 

             return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
            } else 
            {
                 return " <script type='text/javascript'> alert('Không có gói thầu để gửi email'); </script>";
            } 
            
        
         //   return    ProcessController::GuiGoiThau($mail,$noidung);
           
            
        }
    //    return view ('admin.user_list');
     

   }
   // Xem chi tiết Email (by ajax)
   public function ViewEmail(Request $request){
    if ($request->ajax())
    {
        $id = $request->id;
        $user = User::find($id);
        $tukhoa = DB::table('keywords')->where('user_id',$id)->select('keyword')->get();      
          $noidung = array();
      
          $count = 0;
         foreach ($tukhoa as  $bac2) {
          $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%' order by id DESC");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent_emails where user_id='$id_taikhoan' and package_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                                                       

                        }
                }
               
                
    }
        
                     $count = count ($noidung);
                         
        echo  " <div class='modal fade'id='viewmail_model'role='dialog'>
                    <div class='modal-dialog'>    
           
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button'class='close'data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Nội dung email sẽ được gửi đến người dùng</h4>
        </div>
        <div class='modal-body'>

                
         <p> Xin chào <strong>  $user->name </strong>! </p>

        </p>
        <p>Đây là nội dung gói thầu của bạn với từ khóa là: "    ;
             foreach ($tukhoa as $value)
             {
                echo $value->keyword;
                 echo ", ";
             }

       echo "</p> ";

        if ($count > 0 ) {
 
        echo "<table border='1'> <tr> <th>Tên gói thầu</th><th>Bên mời thầu</th> </tr>";

            foreach ($noidung as $value){
                   
                 if (isset ($value->link)){

                    echo "

<tr>
        
    <td>
      <a style='text-decoration: none;' href='"; echo $value->link;echo "'> "; echo $value->title ; echo "</a>
    </td>
    <td>
      <span>"; echo $value->bidder; echo "</span>
    </td>
    
    
    </tr>
                    ";
       
    
    } // ìf nhỏ 
    else {
     break; 
     } //else   
   
    } // foreach 

   

  
echo "</table>";
} 
else {
  echo  "<p>Không có nội dung email cho tài khoản này</p>";
} // elese





     
          echo "<button type='button' class='btn btn-success' data-dismiss='modal'>Đóng</button>

                 </div>
                  </div>
      
             </div>
             </div> 
                 <script>
            $('#viewmail_model').modal('show');
                </script>  ";

    }
   }





/////////////////////////////////////////////////
      // Xem chi tiết Email (by ajax)
   public function ViewEmailvanban(Request $request){
    if ($request->ajax())
    {
        $id = $request->id;
        $user = User::find($id);
        $tukhoa = DB::table('keywords2')->where('user_id',$id)->select('keyword')->get();      
          $noidung = array();
      
          $count = 0;
         foreach ($tukhoa as  $bac2) {
          $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages2 where title like '%$key%'");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent2_email where user_id='$id_taikhoan' and package2_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                                                       

                        }
                }
               
                
    }
        
                     $count = count ($noidung);
                         
        echo  " <div class='modal fade'id='viewmail_model'role='dialog'>
                    <div class='modal-dialog'>    
           
      <div class='modal-content'>
        <div class='modal-header'>
          <button type='button'class='close'data-dismiss='modal'>&times;</button>
          <h4 class='modal-title'>Nội dung email sẽ được gửi đến người dùng</h4>
        </div>
        <div class='modal-body'>

                
         <p> Xin chào <strong>  $user->name </strong>! </p>

        </p>
        <p>Đây là nội dung văn bản của bạn với từ khóa là: "    ;
             foreach ($tukhoa as $value)
             {
                echo $value->keyword;
                echo ", ";
             }
       echo "</p> ";

        if ($count > 0 ) {
 
        echo "<table border='1'> <tr> <th>Văn bản mới</th><th>Ngày cập nhật</th> </tr>";

            foreach ($noidung as $value){
                   
                 if (isset ($value->link)){

                    echo "

<tr>
        
    <td>
      <a style='text-decoration: none;' href='"; echo $value->link;echo "'> "; echo $value->title ; echo "</a>
    </td>
    <td>
      <span>"; echo $value->created_at; echo "</span>
    </td>
    
    
    </tr>
                    ";
       
    
    } // ìf nhỏ 
    else {
     break; 
     } //else   
   
    } // foreach 

   

  
echo "</table>";
} 
else {
  echo  "<p>Không có nội dung email cho tài khoản này</p>";
} // elese





     
          echo "<button type='button' class='btn btn-success' data-dismiss='modal'>Đóng</button>

                 </div>
                  </div>
      
             </div>
             </div> 
                 <script>
            $('#viewmail_model').modal('show');
                </script>  ";

    }
   }



// Xử lý gửi dữ liệu cho từng người.
   public function CustomSendMailvanban (Request $request){
        $user_id  = $request->id;    
        $data =DB::table('users')->where('id',$user_id)->get();
         foreach ($data as $bac1) {
            $mail = $bac1->email;
            $id = $bac1->id;
            $user_name = $bac1->name;
            $tukhoa = DB::table('keywords2')->where('user_id',$id)->get();
            $noidung = array();    

            $count = 0;
            foreach ($tukhoa as  $bac2) {
                $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages2 where title like '%$key%'  order by id DESC");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent2_email where user_id='$id_taikhoan' and package2_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                             $sent_emails = new SentEmail2;
                             $sent_emails->user_id=$id_taikhoan;
                             $sent_emails->package2_id = $id_cankiemtra;
                             $sent_emails->save();
                           

                        }
                }
               
                
                }      

            $count = count ($noidung);
            

        // Gửi email                
            if ($count>0) {
            Mail::send('process.email2',array('noidung'=>$noidung,'count'=>$count,'name'=>$user_name,'keyword'=>$tukhoa),
             function($message) use ($mail) {
                $message->to($mail)->subject('Thông tin văn bản');
            }); 

             return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
            } else 
            {
                 return " <script type='text/javascript'> alert('Không có văn bản để gửi email'); </script>";
            } 
            
        
         //   return    ProcessController::GuiGoiThau($mail,$noidung);
           
            
        }
    //    return view ('admin.user_list');
     

   }



 // Gửi dũ liệu theo danh sách được chọn

    public function SendMailManyvanban (Request $request){
        $user_id  = $request->id;          
        if (count($user_id)==0)
        {
           return " <script type='text/javascript'> alert('Vui lòng chọn người dùng để gửi'); </script>"; 
        }
        else {
       foreach ($user_id as $key => $value) {       
         $data =DB::table('users')->where('id',$value)->get();
         foreach ($data as $bac1) {
            $mail = $bac1->email;
            $id = $bac1->id;
            $user_name = $bac1->name;
            $tukhoa = DB::table('keywords2')->where('user_id',$id)->get();
            $noidung = array();    

            $count = 0;
            foreach ($tukhoa as  $bac2) {
                $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages2 where title like '%$key%' order by id DESC");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent2_email where user_id='$id_taikhoan' and package2_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                             $sent_emails = new SentEmail2;
                             $sent_emails->user_id=$id_taikhoan;
                             $sent_emails->package2_id = $id_cankiemtra;
                             $sent_emails->save();
                           

                        }
                }
               
                
                }      

            $count = count ($noidung);
            

        // Gửi email                
            if ($count>0) {
            Mail::send('process.email2',array('noidung'=>$noidung,'count'=>$count,'name'=>$user_name,'keyword'=>$tukhoa),
             function($message) use ($mail) {
                $message->to($mail)->subject('Thông tin văn bản');
            }); 

             return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
            }
            
        
         //   return    ProcessController::GuiGoiThau($mail,$noidung);
           
            
        }

    //    return view ('admin.user_list');
       }
        return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
}
   }
   ///////////////////////////////////////////////////////
   // Gửi dũ liệu theo danh sách được chọn

    public function SendMailMany (Request $request){
        $user_id  = $request->id;          
        if (count($user_id)==0)
        {
           return " <script type='text/javascript'> alert('Vui lòng chọn người dùng để gửi'); </script>"; 
        }
        else {
       foreach ($user_id as $key => $value) {       
         $data =DB::table('users')->where('id',$value)->get();
         foreach ($data as $bac1) {
            $mail = $bac1->email;
            $id = $bac1->id;
            $user_name = $bac1->name;
            $tukhoa = DB::table('keywords')->where('user_id',$id)->get();
            $noidung = array();    

            $count = 0;
            foreach ($tukhoa as  $bac2) {
                $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%' order by id DESC");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent_emails where user_id='$id_taikhoan' and package_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                             $sent_emails = new SentEmail;
                             $sent_emails->user_id=$id_taikhoan;
                             $sent_emails->package_id = $id_cankiemtra;
                             $sent_emails->save();
                           

                        }
                }
               
                
                }      

            $count = count ($noidung);
            

        // Gửi email                
            if ($count>0) {
            Mail::send('process.email',array('noidung'=>$noidung,'count'=>$count,'name'=>$user_name,'keyword'=>$tukhoa),
             function($message) use ($mail) {
                $message->to($mail)->subject('Thông tin gói thầu');
            }); 

             return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
            }
            
        
         //   return    ProcessController::GuiGoiThau($mail,$noidung);
           
            
        }

    //    return view ('admin.user_list');
       }
        return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
}
   }

 // Xem thông tin Email đến người dùng
   public function ViewMail (Request $request){
          $id =  $request->id;     
          $name = DB::table('users')->where('id',$id)->select('name')->get(); 
          $tukhoa = DB::table('keywords')->where('user_id',$id)->get();
          $noidung = array();
      
          $count = 0;
         foreach ($tukhoa as  $bac2) {
           $key = $bac2->keyword;        
           $goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%' ");      
        
             $count +=count($goithau);       
        
        array_push($noidung,$goithau);
        
        }        
                       
       return view('admin.view_mail',compact(['noidung','count','tukhoa','name']));


   }

// Xóa gói thầu đã chọn.
   public function DeletePackage (Request $request){
  if ($request->ajax()){
    $id = $request->id;
    foreach ($id as $key => $value) {
          Packages::destroy($value);

    }

    //return view ('admin.list_package',compact('success'));
     
  }

} 

public function DeletePackagevanban (Request $request){
  if ($request->ajax()){
    $id = $request->id;
    foreach ($id as $key => $value) {
          Packages2::destroy($value);

    }

    //return view ('admin.list_package',compact('success'));
     
  }

} 
// Hiện/ ẩn gói thầu
public function ShowAndHide (Request $request){
    if ($request->ajax()){

    $id = $request->id;
     if(isset ($id)  ){
    foreach ($id as $key => $value) {
      $packages = Packages::find ($value);
      if (isset($packages)){
      if (is_null($packages->hided)){
             $packages->hided = 1;
         }
          else    {
     $packages->hided = null;      

    }
    $packages->save();
   }
}

}
}
}
// Xóa người dùng đã chọn
  public function DeleteManyUser (Request $request){
  if ($request->ajax()){
    $id = $request->id;
    foreach ($id as $key => $value) {
          User::destroy($value);

    }

    //return view ('admin.list_package',compact('success'));
    } 
  }

// Chọn gói thầu theo lĩnh vực
    public function GetLinhVuc (Request $request){
      if ($request->ajax())
        {
          
          $ma_linh_vuc = $request->ma_linh_vuc; 
          if($ma_linh_vuc==='all') {
            $goi_thau = DB::table('packages')->orderBy('id', 'desc')->get();
            $i =1 ;
                      foreach ($goi_thau as $value) {
                         $ngaycapnhat =  substr($value->created_at,0,10); 
                         $ngayhientai = date('Y-m-d');   

                        echo "<tr> <td><input type='checkbox' name='id[]'' class='checkbox' value='{!!$value->id!!}'></td>   <td>$i</td><td><a href='$value->link' target ='_blank'>$value->title";                          
                         if ($ngayhientai == $ngaycapnhat) {
                            echo "<span style='color: red;' class='dm_new'><strong> Hot! </strong></span> <span class='editlinktip hasTip' style='text-decoration: none; color: #333;'>";
                         echo "<img src='"; echo asset('public/image/tooltip.png'); 
                         echo "' border='0' alt='Tooltip'></span> </td>";
                     }
                        echo "<td>$value->bidder</td>";
                          echo "<td align='center'>";
                         echo substr($value->created_at,0,10); 
                          echo " </td> ";
                         if (is_null($value->hided))
                            echo "                <td align='center'>   <span class='glyphicon glyphicon glyphicon-ok' aria-hidden='true' style='color:green'></span>  </td>";
                         else 
                         echo "<td align='center'>
                           <span class='glyphicon  glyphicon glyphicon-remove' aria-hidden='true' style='color:red'></span> </td> ";
                        

                      
                        $i++;
          }
}
          else {
          $goi_thau = DB::table('packages')->where('cate_id',$ma_linh_vuc)->orderBy('id', 'desc')->get();               $i =1 ;
                      foreach ($goi_thau as $value) {
                         $ngaycapnhat =  substr($value->created_at,0,10); 
                         $ngayhientai = date('Y-m-d');    
                        echo "<tr><td><input type='checkbox' name='id[]'' class='checkbox' value='{!!$value->id!!}'></td> <td>$i</td><td><a href='$value->link' target ='_blank'>$value->title";                          
                         if ($ngayhientai == $ngaycapnhat) {
                            echo "<span style='color: red;' class='dm_new'><strong> Hot! </strong></span> <span class='editlinktip hasTip' style='text-decoration: none; color: #333;'>";
                         echo "<img src='"; echo asset('public/image/tooltip.png'); 
                         echo "' border='0' alt='Tooltip'></span> </td>";
                     }
                        echo "<td>$value->bidder</td>";
                        echo "<td align='center'>";
                         echo substr($value->created_at,0,10); 
                          echo " </td> ";
                         if (is_null($value->hided))
                            echo "                <td align='center'>   <span class='glyphicon glyphicon glyphicon-ok' aria-hidden='true' style='color:green'></span>  </td>";
                         else 
                         echo "<td align='center'>
                           <span class='glyphicon  glyphicon glyphicon-remove' aria-hidden='true' style='color:red'></span> </td> ";
                        $i++;
                          }
}

        }
        else echo "không";

    }

//// Gửi email cho tất cả user
public function SentEmailAllUser (){
    $data =DB::select("select * from users where status = '1' and level = '1' and receive_email = '1' ");
   
        $title = 'Đây là mail mới nhất';
         foreach ($data as $bac1) {
            $mail = $bac1->email;
            $id = $bac1->id;
            $user_name = $bac1->name;
            $tukhoa = DB::table('keywords')->where('user_id',$id)->get();
            $noidung = array();    

            $count = 0;
            foreach ($tukhoa as  $bac2) {
                $key = $bac2->keyword;              
                $goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%' order by id DESC");      
                
                foreach ($goithau as $key => $value) {
                        $id_cankiemtra = $value->id;  
                        $id_taikhoan  = $id;                  
                        $ketquakiemtra = DB::select("select * from sent_emails where user_id='$id_taikhoan' and package_id ='$id_cankiemtra'"); 
                                        
                    
                        if (count($ketquakiemtra)==0){
                            //echo $value->title;                                 
                             array_push($noidung,$value);
                             $sent_emails = new SentEmail;
                             $sent_emails->user_id=$id_taikhoan;
                             $sent_emails->package_id = $id_cankiemtra;
                             $sent_emails->save();
                           

                        }
                }
               
                
                }                 
            
         $count = count ($noidung);
         echo $count;
        // Gửi email                
            if ($count>0) {
            Mail::send('process.email',array('noidung'=>$noidung,'count'=>$count,'name'=>$user_name,'keyword'=>$tukhoa),
             function($message) use ($mail) {
                $message->to($mail)->subject('Thông tin gói thầu');
            }); 

             return " <script type='text/javascript'> $('#loader').hide(); alert('Gửi thành công'); </script>";
            }
            
            
        
         //   return    ProcessController::GuiGoiThau($mail,$noidung);
            
        }
}


   

}
