<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DataStore extends Model {


	protected $table ='data_stores';
	protected $fillable = ['id','title','link','bidder','hided'];
	//public $timestamps = false;




}
