<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model {

	protected $table ='sent_emails';
	protected $fillable = ['id','user_id','package_id'];
	public $timestamps = false;

}
