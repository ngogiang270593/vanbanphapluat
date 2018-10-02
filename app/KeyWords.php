<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class KeyWords extends Model {
	protected $table = 'keywords';

	protected $fillable = ['id', 'user_id','keyword'];

	//

}


