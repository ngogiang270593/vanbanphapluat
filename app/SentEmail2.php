<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SentEmail2 extends Model {

	protected $table ='sent2_email';
	protected $fillable = ['id','user_id','package2_id'];
	public $timestamps = false;

}
