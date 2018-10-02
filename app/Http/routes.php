<?php

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get ('show_data',function(){
	$data = App\Packages::all();
	echo "<pre>";
	print_r($data);
	echo "</pre>";
});
Route::get('get_data','DataController@Show');

// Đăng ký thành viên
Route::get ('authen/getRegister',['as'=>'getRegister','uses'=>'Auth\AuthController@getRegister']);
// Xác nhận thông tin
Route::get ('authen/Registersuccess',['as'=>'Registersuccess','uses'=>'Auth\AuthController@Registersuccess']);
// Link EMail
Route::get ('register/success/{token}',['as'=>'Registersuccess','uses'=>'Auth\AuthController@VerifyEmail']);
// Đang ký thành công
Route::get ('welcome',['as'=>'welcome','uses'=>'Auth\AuthController@Welcome']);

Route::post ('authen/postRegister',['as'=>'postRegister','uses'=>'Auth\AuthController@postRegister']);
// Đăng nhập
Route::get ('authen/getLogin',['as'=>'getLogin','uses'=>'Auth\AuthController@getLogin']);
Route::post ('authen/postLogin',['as'=>'postLogin','uses'=>'Auth\AuthController@postLogin']);


// Trang chu User
Route::group(['prefix'=>'user','middleware'=>'auth'],function(){

	Route::get('home',['as'=>'home',function(){
	return view('user.index');}]);
	Route::get('homevanban',['as'=>'homevanban',function(){
	return view('user.indexvanban');
}]);

// Thông tin tài khoản
// Get Edit Myaccount
Route::get ('getEditMyAccount',['as'=>'getEditMyAccount','uses'=>'UserController@GetEditMyAccount']);
// Process editaccount by Ajax
Route::get ('edit_account_user',['as'=>'edit_account_user','uses'=>'UserController@EditMyAccount']);

// Chọn lĩnh vực
Route::get('linhvuc',['as'=>'linhvuc','uses'=>'UserController@GetLinhVuc']);
//Thêm từ khóa
Route::post('addkeygoithau',['as'=>'addkeygoithau','uses'=>'UserController@AddKey']);
Route::get('addkeyvanban',['as'=>'addkeyvanban','uses'=>'UserController@AddKeyvanban']);
// Xóa nhiều từ khóa
Route::get('deletekey',['as'=>'deletekey','uses'=>'UserController@DeleteKey']);
Route::post('deletekey_goithau',['as'=>'deletekey_goithau','uses'=>'UserController@DeleteKey_GoiThau']);
Route::get('deletekey1',['as'=>'deletekey1','uses'=>'UserController@DeleteKey1']);
Route::get('deletekey_vanban',['as'=>'deletekey_vanban','uses'=>'UserController@DeleteKey_VanBan']);
// Trang Quan ly tai khoan
Route::get('profile',['as'=>'profile','uses'=>'UserController@profile']);


Route::post('get_info_keyword_vanban',['as'=>'get_info_keyword_vanban','uses'=>'UserController@get_keyword_vanban']);
Route::post('editkeyvanban',['as'=>'editkeyvanban','uses'=>'UserController@EditKeyVanBan']);
Route::post('get_keyword_goithau',['as'=>'get_keyword_goithau','uses'=>'UserController@get_keyword_goithau']);
Route::post('editkeygoithau',['as'=>'editkeygoithau','uses'=>'UserController@EditKeyGoiThau']);
Route::post('image',['as'=>'uploadimage','uses'=>'AdminController@UpLoadImage']);
// Edit Account
//Route::get('get_edit_account',['as'=>'get_edit_account','uses'=>'UserController@GetEditAccount']);
Route::post('post_edit_account',['as'=>'post_edit_account','uses'=>'UserController@postEditAccount']);



// TÌm gói thâu theo từ khóa
Route::get('find_package',['as'=>'find_package',function(){
	return view ('user.find_package');
}]);
Route::get('find_package_vanban',['as'=>'find_package_vanban',function(){
	return view ('user.find_package_vanban');
}]);
// Quan ly tu khoa
Route::get('keyword',['as'=>'keyword','uses'=>'UserController@GetKeyWord']);

Route::get('keywordvanban',['as'=>'keywordvanban','uses'=>'UserController@GetKeyWordvanban']);
});
//Logout
Route::get('authen/getLogout',['as'=>'getLogout','uses'=>'Auth\AuthController@getLogout']);
// phan chuc năng Admin
Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

	Route::get('home',function(){
	return view ('admin.user_list');
});
	// Hiện/ Ản gói thầu
Route::get ('showandhide',['as'=>'showandhide','uses'=>'AdminController@ShowAndHide']);
	// Get Edit Myaccount (Thông tin tai khoan)
Route::get ('getEditMyAccount',['as'=>'getEditMyAccount','uses'=>'AdminController@GetEditMyAccount']);
// Process editaccount by Ajax
Route::get ('edit_account',['as'=>'edit_account','uses'=>'AdminController@EditMyAccount']);
	// THống kê
Route::get ('dash_board',['as'=>'dash_board','uses'=>'AdminController@GetDashBoard']);
// Lấy thông tin theo lĩnh vực
Route::get('linhvuc',['as'=>'linhvuc','uses'=>'UserController@GetLinhVuc']);
// Xem nội dung emmail trước khi gửi (By ajax)
Route::get ('view_email',['as'=>'view_email','uses'=>'AdminController@ViewEmail']);
Route::get ('view_email_vanban',['as'=>'view_email_vanban','uses'=>'AdminController@ViewEmailvanban']);
	// Gửi email đến tất cả người dùng trong hệ thống
Route::get ('sent_mail',['as'=>'sent_mail','uses'=>'AdminController@SendMail']);
	// Gửi email tùy chọn từng người
Route::get ('custom_send_mail',['as'=>'custom_send_mail','uses'=>'AdminController@CustomSendMail']);

Route::get ('custom_send_mail_vanban',['as'=>'custom_send_mail_vanban','uses'=>'AdminController@CustomSendMailvanban']);	// Gửi email cho những người được chọn
Route::get ('sent_mail_many',['as'=>'sent_mail_many','uses'=>'AdminController@SendMailMany']);

Route::get ('sent_mail_many_vanban',['as'=>'sent_mail_many_vanban','uses'=>'AdminController@SendMailManyvanban']);
	// Cập nhật dữ liệu
Route::get("process/update_package",['as'=>'update_package','uses'=>'ProcessController@UpdatePackage']);

Route::get("process/update_package_vanban",['as'=>'update_package_vanban','uses'=>'ProcessController@UpdatePackagevanban']);
// Edit Model
Route::get ('model_keyword',['as'=>'model_keyword','uses'=>'AdminController@keywordModel']);
// Send Email Setting
Route::get ('send_email_setting',['as'=>'send_email_setting','uses'=>'AdminController@SendEmailSetting']);

Route::get ('send_email_setting_vanban',['as'=>'send_email_setting_vanban','uses'=>'AdminController@SendEmailSettingvanban']);
// Xem chi tiết nội dung email
Route::get ('view_mail/{id}',['as'=>'view_mail','uses'=>'AdminController@ViewMail']);

Route::get ('view_mail_vanban/{id}',['as'=>'view_mail_vanban','uses'=>'AdminController@ViewMail']);
	// xem danh sách gói thầu
Route::get('list-package',['as'=>'list-package','uses'=>'AdminController@GetListPackage']);

Route::get('list-package-kho',['as'=>'list-package-kho','uses'=>'AdminController@GetListPackagekho']);
Route::get('list-package-vanban',['as'=>'list-package-vanban','uses'=>'AdminController@GetListPackagevanban']);
Route::get('list-user',['as'=>'list-user','uses'=>'AdminController@UserList']);


Route::get('add-user',['as'=>'add-user','uses'=>'AdminController@GetUserAdd']);
Route::get('add_account',['as'=>'adminadd','uses'=>'AdminController@AddUser']);
Route::get('delete-user/{id}',['as'=>'admindelete',function($id){
	DB::table('users')->where('id',$id)->delete();
	return redirect('admin/list-user');
}]);
// Xóa tài khoản (one)
Route::get('user_delete',['as'=>'user_delete','uses'=>'AdminController@DeleteUser']);
// xóa tài khoản (many)
Route::get('user_delete_many',['as'=>'user_delete_many','uses'=>'AdminController@DeleteManyUser']);
// Trang Quan ly tai khoan
Route::get('admin_profile',['as'=>'admin_profile','uses'=>'AdminController@GetProfile']);
// Edit Admin Account
Route::get('get_edit_account_admin',['as'=>'get_edit_account_admin','uses'=>'AdminController@GetEditAccount']);
// Edit Account by Ajax
Route::get('edit_ajax',['as'=>'edit_ajax','uses'=>'AdminController@GetEditUser']);

Route::get('get_edit_account_admin',['as'=>'get_edit_account_admin','uses'=>'AdminController@GetEditAccount']);
Route::post('post_admin_edit',['as'=>'post_admin_edit','uses'=>'AdminController@postEditAccount']);
//Up Avatar

Route::post('image',['as'=>'uploadimage','uses'=>'AdminController@UpLoadImage']);

/*Route::get('edit-user/{id}',['as'=>'edit-user',function($id){
	    $data = App\User::findOrFail($id)->toArray();
    	return view ('admin.user_edit',compact('data'));
}]);*/
// xóa gói thầu
// Xóa nhiều từ khóa
Route::get('delete_package',['as'=>'delete_package','uses'=>'AdminController@DeletePackage']);
Route::get('delete_package_vanban',['as'=>'delete_package_vanban','uses'=>'AdminController@DeletePackagevanban']);

Route::get('edit-user',['as'=>'edit-user','uses'=>'AdminController@postEditUser']);
// xem gói thầu theo lĩnh vực
Route::get('linhvuc_admin',['as'=>'linhvuc_admin','uses'=>'AdminController@GetLinhVuc']);
Route::get('sentEmailAllUser',['as'=>'sentEmailAllUser','uses'=>'AdminController@SentEmailAllUser']);

});
Route::get('longupload',function(){
	return view ('file.upload_form');
});

Route::post('postUpload',['as'=>'long',function(){
	$name = Input::file('book')->getClientOriginalName();
	Input::file('book')->move('img',$name);
	return "File da upload";
}]);

Route::get('guimail',function(){
	return view ('process.send_email');
});
Route::post('sent',['as'=>'sent', 'uses'=>'ProcessController@SendEmail']);
Route::get('guigoithau',['as'=>'guigoithau', 'uses'=>'ProcessController@SendAll']);
Route::get('process/guiemail',['as'=>'guiemail', 'uses'=>'ProcessController@GuiEmail']);

Route::get('homeview',function(){
	return view ('home');
});
//////////Phần webservice cho android
// Xuất dữ liệu ra  Json
Route::get('android/add_key',['as'=>'addkey', 'uses'=>'ProcessController@AddKeyWord']);
// Keyword
Route::get ('android/keyword/{id}',function($id){
	      $keywords = DB::select("Select * from keywords where user_id = '$id'");
	      return json_encode($keywords);

	});



Route::get ('getJsonAll',['as'=>'getJsonAll', 'uses'=>'ProcessController@GetAllData']);

Route::get('laydulieu',['as'=>'laydulieu','uses'=>'ProcessController@LayDuLieu']);
/*
Route::get('/{any}', function ($any) {
	$home = URL('home');

 return redirect($home);

})->where('any', '.*');
*/
Route::get('',function(){
	$home = URL('home');

 return redirect($home);
});
Route::get ('login_android',['as'=>'login_android', 'uses'=>'UserController@LoginAdroid']);

Route::get ('getdata_test',function(){
 return view('process.getdata');
});
Route::get('day',function(){
	// Ngày hiện tại
	$ngayhientai = date('Y-m-d');
	// Giờ hiện tại
	$data = DB::table('packages')->where('id',155)->select('created_at')->get();
	foreach ($data as $key => $value) {
		$ngaycapnhat =  substr($value->created_at,0,10);
		if ($ngayhientai == $ngaycapnhat)
			echo "New";
		else echo "not";

	}

});


// So sánh
Route::get('demsodong',function(){
	$size =  App\Packages::get()->count();
	try {
			if ($size > 30){
			$dt =  App\Packages::orderBy('id', 'DESC')->get()->toArray();
			for ($i= 30 ; $i<$size ; $i++)
	     		 {
				      	   $store = new App\DataStore;
				      	   $store->id = $dt[$i]['id'];
				      	   $store->title = $dt[$i]['title'];
				      	   $store->link = $dt[$i]['link'];
				      	   $store->bidder = $dt[$i]['bidder'];
				      	   $store->cate_id = $dt[$i]['cate_id'];
				      	   $store->created_at = $dt[$i]['created_at'];
				      	   $store->updated_at = $dt[$i]['updated_at'];
				      	   $store->save();
				      	   App\Packages::destroy($dt[$i]['id']);

	     		 }
	      	 }
      	}

 	catch (Exception $e) {
    		echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
});

Route::get("/test",function(){
	return view("process.getdatavanban");
});
