<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class MotGoiThau extends Controller {
	var $title;
	var $link;
    var $bidder;
    function __construct( $Title, $Link,$Bidder ){
  	 $this->title = $Title;
  	 $this->link  = $Link;
  	 $this->bidder = $Bidder;
}

	
}
