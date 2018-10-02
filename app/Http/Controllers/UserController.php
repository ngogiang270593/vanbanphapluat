<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\KeyWords;
use App\KeyWords2;
use Illuminate\Http\Request;
use Input;
use Auth;
use DB;
use App\User;
use File;	
use App\Images;


class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
public function GetKeyWord (){
    return view ('user.keyword_setting');
}

public function GetKeyWordvanban (){
    return view ('user.keyword_setting_vanban');
}
public function profile (){    	
    return view ('user.account_manager');		
}
public function AddKey (Request $request){
	if ($request->ajax()){
		$keyword = $request->keyword;
		$user_id =$request->user_id;		
		$tukhoa = new KeyWords;
		$tukhoa->keyword = $keyword;
		$tukhoa->user_id = $user_id;		
		$tukhoa->save();		
	}
}

public function AddKeyvanban (Request $request){
    if ($request->ajax()){
        $keyword = $request->keyword;
        $user_id =$request->user_id;        
        $tukhoa1 = new KeyWords2;
        $tukhoa1->keyword = $keyword;
        $tukhoa1->user_id = $user_id;        
        $tukhoa1->save();        
    }
}

public function DeleteKey (Request $request){
	if ($request->ajax()){
		$id = $request->id;
		foreach ($id as $key => $value) {
					KeyWords::destroy($value);
		}
    } 
      
}

public function DeleteKey1 (Request $request){
    if ($request->ajax()){
        $id = $request->id;
        foreach ($id as $key => $value) {
                    KeyWords2::destroy($value);
        }
    }      
}

public function DeleteKey_VanBan(Request $request){
    if($request->ajax()){
        $id = $request->id;
        KeyWords2::destroy($id);
    }
}

public function postUpload(Request $request){
	if ($request->ajax()){
        $folderPath = 'public/photo/image';
        if (!File::isDirectory($folderPath)) {
            File::makeDirectory($folderPath, 0755, true); 
        }
        $file = Input::file('file');
        $filename = '';
        if(null != $file){
            $filename = $file->getClientOriginalName();
            $upload_success = Input::file('file')->move($folderPath, $filename);
        } 
    }
    else {echo "No request";}
}

 public function UpLoadImage (Request $request){ 
 	  if ($request->file('book')){
        $id = Auth::user()->id; 	
        $name = $id."+".Input::file('book')->getClientOriginalName();
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
            Input::file('book')->move('public/photo/image', $name); 
            $image = new Images;
            $image->user_id = $id;
            $image->src = $src;
            $image->save();
            return view ('user.account_manager');
            
        } else 
        {
            Input::file('book')->move('public/photo/image', $name); 
        $image = new Images;
        $image->user_id = $id;
        $image->src = $src;
        $image->save();
        return 'File was moved.';
        }  
 	} else {
 		$erorr = "Bạn chưa chọn ảnh";
 		 return view('user.account_manager',compact('erorr'));
 	}
 }

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
                            </div>";
                           
                            echo " <div class='form-group'>
                                <label>Nhập lại mật khẩu</label>
                                <input type='password' class='form-control' value='' name='txtRePass' placeholder='Nhập lại mật khẩu' />
                            </div>   ";
                              echo "<div class='form-group'>
                                <label style='margin-top: -5px; '  >Nhận thông tin gói thầu mới qua email</label>
                                <input style='margin-left:5px; margin-top:10px; ' type='checkbox'   name='cbEmail' class = 'cbEmail' ";

                                    if ($data['receive_email']==1) 
                                        echo "checked = 'checked'";

                                echo " id='cbEmail' value='";
                                echo $data['receive_email'];
                                echo "'/>
                            </div>";
   
                        echo "<form>";
  echo " <script>
            $('#EditModel').modal('show');
                </script> ";
       // DB::table('users')->where('id',$id)->delete();
}
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
        $user->receive_email = $request->cbEmail;
        $user->remember_token = $request->input('remember_token');          
        $user->save();      
        $success = "<script type='text/javascript'>
        alert ('Thay đổi thông tin thành công');
        location.reload();
        </script>";
        return  $success;
            }

    }

public function GetEditAccount (){
	$id = Auth::user()->id;
	$data = User::findOrFail($id)->toArray();   
	return view ('user.edit_account',compact('data'));
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
		return view ('user.account_manager',compact('success'));

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
                        echo "<tr><td>$i</td><td><a href='$value->link' target ='_blank'>$value->title";                          
                         if ($ngayhientai == $ngaycapnhat) {
                            echo "<span style='color: red;' class='dm_new'><strong> Hot! </strong></span> <span class='editlinktip hasTip' style='text-decoration: none; color: #333;'>";
                         echo "<img src='"; echo asset('public/image/tooltip.png'); 
                         echo "' border='0' alt='Tooltip'></span> </td>";
                     }
                        echo "<td>$value->bidder</td>";

                   		
                        $i++;
    			}
}
    			else {
    			$goi_thau = DB::table('packages')->where('cate_id',$ma_linh_vuc)->orderBy('id', 'desc')->get();   						$i =1 ;
                      foreach ($goi_thau as $value) {
                         $ngaycapnhat =  substr($value->created_at,0,10); 
                         $ngayhientai = date('Y-m-d');    
                        echo "<tr><td>$i</td><td><a href='$value->link' target ='_blank'>$value->title";                          
                         if ($ngayhientai == $ngaycapnhat) {
                            echo "<span style='color: red;' class='dm_new'><strong> Hot! </strong></span> <span class='editlinktip hasTip' style='text-decoration: none; color: #333;'>";
                         echo "<img src='"; echo asset('public/image/tooltip.png'); 
                         echo "' border='0' alt='Tooltip'></span> </td>";
                     }
                        echo "<td>$value->bidder</td>";
                         echo "<td align='center'>";
                         echo substr($value->created_at,0,10); 
                          echo " </td> ";
                        $i++;
                          }
}

    		}
    		else echo "không";

    }
   
    public function get_keyword_vanban(Request $request){
        $post = $request->all();
        $id = $post['id'];
        $sql = DB::table('keywords2')->where('id', $id)->first();
        header("Content-type:text/x-json");
        return json_encode($sql);
    }

    public function EditKeyVanBan(Request $request){
        $post = $request->all();
        $id = $post['id'];
        $user_id = $post['user_id'];
        $keyword = $post['keyword'];

        $data = array(
            'user_id'   => $user_id,
            'keyword'   => $keyword
        );
        $sql = DB::table('keywords2')->where('id',$id)->update($data);
        $json = Array();
        if($sql > 0){
            $json['success'] = "Cập nhật thành công";
        } else {
            $json['error'] = "Cập nhật thất bại";
        }
        return json_encode($json);
    }

    public function DeleteKey_GoiThau(Request $request){
        if($request->ajax()){
            $id = $request->id;
            // KeyWords::destroy($id);
            DB::table('keywords')->where('id',$id)->delete();
        }
    }

    public function get_keyword_goithau(Request $request){
        $post = $request->all();
        $id = $post['id'];
        $sql = DB::table('keywords')->where('id', $id)->first();
        header("Content-type:text/x-json");
        return json_encode($sql);
    }

    public function EditKeyGoiThau(Request $request){
        $post = $request->all();
        $id = $post['id'];
        $user_id = $post['user_id'];
        $keyword = $post['keyword'];

        $data = array(
            'user_id'   => $user_id,
            'keyword'   => $keyword
        );
        $sql = DB::table('keywords')->where('id',$id)->update($data);
        $json = Array();
        if($sql > 0){
            $json['success'] = "Cập nhật thành công";
        } else {
            $json['error'] = "Cập nhật thất bại";
        }
        return json_encode($json);
    }

}