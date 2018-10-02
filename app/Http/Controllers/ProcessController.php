<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use App\Packages;
use App\User;
use App\Http\Controllers\MotGoiThau;
use Illuminate\Http\Request;

class ProcessController extends Controller {

	public function SendEmail (Request $request){
		$content  = $request->content;
			$emails = ['phulong95@gmail.com','trolyao.goithau@gmail.com'];
			// send ('tempblade,mảng nội dung,function($mesage)')
			Mail::send('process.email',array('content' => $content ),
			 function($message) use ($emails) {
				$message->to($emails)->subject('Phan hồi');
			});

			//Session:flash('flash_message','Gửi mail thanh công');
			return view ('process.send_email');


	}

	public function GuiGoiThau ($emails , $noidung ){
			//$emails = ['phulong95@gmail.com','trolyao.goithau@gmail.com'];
			// send ('tempblade,mảng nội dung,function($mesage)')
			Mail::send('process.email',array('noidung'=>$noidung),
			 function($message) use ($emails) {
				$message->to($emails)->subject('Phan hồi');
			});
	}

	public function SendAll(){

		$emails =DB::table('users')->select('email')->get();
		$email  = array();

		foreach ($emails as $value) {
			array_push($email,$value->email);
		}
		$title = 'Tôi Là Trợ Lý Ảo';

	return 	ProcessController::GuiGoiThau($email,$title);
	}



	public function GuiEmail () {
		$data =DB::table('users')->get();
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
				$goithau = DB::select("select * from packages where title like '%$key%' or bidder like  '%$key%'");
				$count +=count($goithau);
				array_push($noidung,$goithau);
			}

			if ($count>0) {
			Mail::send('process.email',array('noidung'=>$noidung,'count'=>$count,'name'=>$user_name),
			 function($message) use ($mail) {
				$message->to($mail)->subject('Phan hồi');
			});
		}
		 //   return 	ProcessController::GuiGoiThau($mail,$noidung);
		}
	}


    public function UpdatePackage (Request $request){

       if ($request->ajax()){
       		return view("process.getdata", compact('success'));
       }
    }

    public function UpdatePackagevanban (Request $request){

       if ($request->ajax()){
       		return view("process.getdatavanban", compact('success'));
       }
    }

// Thêm từ khóa (Android)
   public function AddKeyWord (Request $request){
      	$response = array();
   		if ( isset($request->id) && isset($request->add) && isset($request->key_word)) {

   			$response['result'] = "ok";
   			return response()->json($response);
   		}
   		else
   		{
   			$response['result'] = "not";
   			return response()->json($response);
   		}
   }

// Lay thông tin goi thau theo  từ khóa
// lấy thông tin tất cả gói thầu sang JSON
    public function GetAllData (){
    	$data=DB::table('packages')->get();
    	return response()->json($data);
    }

}