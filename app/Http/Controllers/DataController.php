<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\GoiThau;
class DataController extends Controller {


	public function Show (){
		$data =GoiThau::all()->tojSon();
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	
}


}
